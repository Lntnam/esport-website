<?php
namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Match;
use App\Repositories\MatchRepository;
use App\Repositories\OpponentRepository;
use App\Repositories\TournamentRepository;
use App\Traits\GameController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Setting;
use Validator;

class MatchController extends BaseController
{
    use GameController;

    public function index($game)
    {
        $this->validateGame($game);

        return view('match.manage', ['game' => $game]);
    }

    public function data($game, Request $request)
    {
        $this->validateGame($game);
        $params = $this->retrieveSortParams($request, ['sort' => 'schedule', 'order' => 'desc']);

        return response()->json(MatchRepository::query($request->input('search'), $game, $params['sort'], $params['order']));
    }

    public function create($game, Request $request)
    {
        $this->validateGame($game);
        $tournaments = TournamentRepository::getList($game);
        $opponents = OpponentRepository::getList($game);

        if ($request->has('game')) {

            $input = $request->all();
            $validator = Validator::make($input, MatchRepository::getCreateValidationRules());
            if (!$validator->fails()) {

                try {
                    $match = MatchRepository::create($input);
                } catch (QueryException $ex) {
                    return redirect()
                        ->back()
                        ->withErrors([$ex->getMessage()])
                        ->withInput()
                        ->with('tournaments', $tournaments)
                        ->with('opponents', $opponents);
                }

                // Set flag to send fixture today
                Setting::set('fixtures_send_today', 1);

                // Get opponent name for message
                $opponent_name = 'TBD';
                if (!empty($match->opponent)) {
                    $opponent_name = $match->opponent->name;
                }

                // Success
                return redirect()
                    ->route('back.fixtures.index', ['game' => $game])
                    ->with('status', 'success')
                    ->with('message', sprintf('Match against %s was created.', $opponent_name));
            }

            // Validation fails
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('tournaments', $tournaments)
                ->with('opponents', $opponents);
        }

        return view('match.create', [
            'game' => $game,
            'model' => new Match(),
            'tournaments' => $tournaments,
            'opponents' => $opponents
        ]);
    }

    public function delete(Request $request, $id = null)
    {
        if ($request->has('id')) {
            $input = $request->all();
            $id = $input['id'];

            $match = MatchRepository::read($id);
            if (!$match) {
                abort(404);
            }

            $game = $match->game;
            // Get opponent name for message
            $opponent_name = 'TBD';
            if (!empty($match->opponent)) {
                $opponent_name = $match->opponent->name;
            }

            try {
                $match->delete();
            }
            catch (QueryException $ex) {
                return redirect()
                    ->back()
                    ->withErrors([$ex->getMessage()])
                    ->withInput();
            }

            return redirect()
                ->route('back.fixtures.index', ['game' => $game])
                ->with('status', 'success')
                ->with('message', sprintf('Match against %s was deleted.', $opponent_name));
        }

        $match = MatchRepository::read($id);

        if (!$match) {
            abort(404);
        }
        return view('match.delete', ['model' => $match, 'game' => $match->game]);
    }

    public function update(Request $request, $id = null)
    {
        if ($request->has('id')) {
            $input = $request->all();
            $match = MatchRepository::read($input['id']);
            if (!$match) {
                abort(404);
            }
            $tournaments = TournamentRepository::getList($match->game);
            $opponents = OpponentRepository::getList($match->game);

            $validator = Validator::make($input, MatchRepository::getUpdateValidationRules($match));
            if (!$validator->fails()) {
                try {
                    $repo = new MatchRepository($match);
                    $repo->update($input);
                } catch (QueryException $ex) {
                    return redirect()
                        ->back()
                        ->withErrors([$ex->getMessage()])
                        ->withInput()
                        ->with('tournaments', $tournaments)
                        ->with('opponents', $opponents);
                }

                // Get opponent name for message
                $opponent_name = 'TBD';
                if (!empty($match->opponent)) {
                    $opponent_name = $match->opponent->name;
                }

                // Success
                return redirect()
                    ->route('back.fixtures.index', ['game' => $match->game])
                    ->with('status', 'success')
                    ->with('message', sprintf('Match against %s was updated.', $opponent_name));
            }

            // Validation fails
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('tournaments', $tournaments)
                ->with('opponents', $opponents);
        }

        $match = MatchRepository::read($id);
        if (!$match) {
            abort(404);
        }

        $tournaments = TournamentRepository::getList($match->game);
        $opponents = OpponentRepository::getList($match->game);

        return view('match.update')
            ->with('model', $match)
            ->with('game', $match->game)
            ->with('tournaments', $tournaments)
            ->with('opponents', $opponents);
    }
}
