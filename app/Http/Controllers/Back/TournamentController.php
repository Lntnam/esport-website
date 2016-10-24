<?php
namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Tournament;
use App\Repositories\TournamentRepository;
use App\Traits\GameController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Validator;

class TournamentController extends BaseController
{
    use GameController;

    public function data($game, Request $request)
    {
        $this->validateGame($game);
        $params = $this->retrieveSortParams($request);

        return response()->json(TournamentRepository::search($request->input('search'), $game, $params['sort'], $params['sort']));
    }

    public function index($game)
    {
        $this->validateGame($game);

        return view('tournament.manage', ['game' => $game]);
    }

    public function ajaxCreate($game, Request $request)
    {
        $this->validateGame($game);
        $input = $request->all();
        if ($request->has('game')) {
            if (empty($input['prize']))
                $input['prize'] = 0;

            $validator = Validator::make($input, TournamentRepository::getCreateValidationRules());
            if (!$validator->fails()) {
                try {
                    $tour = TournamentRepository::create($input);
                } catch (QueryException $ex) {
                    $request->flash();

                    return response()->json(new AjaxResponse(false,
                        (string)view('tournament.create_modal', ['game' => $game, 'model' => new Tournament()])
                            ->with('errors', new MessageBag([$ex->getMessage()]))
                    ));
                }

                return response()->json(new AjaxResponse(true, $tour));
            }
            $request->flash();

            return response()->json(new AjaxResponse(false,
                (string)view('tournament.create_modal', ['game' => $game, 'model' => new Tournament()])
                    ->with('errors', $validator->errors())
            ));
        }

        return view('tournament.create_modal', ['game' => $game, 'model' => new Tournament()]);
    }

    public function delete(Request $request, $id = null)
    {
        if ($request->has('id')) {

            $model = TournamentRepository::readWithCount($request->input('id'));
            if (!$model) {
                abort(404);
            }

            $game = $model->game;
            $deletable = $model->matches_count == 0;
            if (!$deletable) {
                return redirect()
                    ->back()
                    ->with('model', $model)
                    ->with('deletable', $deletable)
                    ->withErrors(new MessageBag(['This tournament cannot be deleted.']));
            }

            // Get tournament name for message
            $name = $model->name;

            try {
                $model->delete();
            } catch (QueryException $ex) {
                return redirect()
                    ->back()
                    ->with('model', $model)
                    ->with('deletable', $deletable)
                    ->withErrors([$ex->getMessage()]);
            }

            return redirect()
                ->route('back.tournaments.index', ['game' => $game])
                ->with('status', 'success')
                ->with('message', sprintf('Tournament %s was deleted.', $name));
        }

        $model = TournamentRepository::readWithCount($id);

        if (!$model) {
            abort(404);
        }

        $deletable = $model->matches_count == 0;

        return view('tournament.delete')
            ->with('model', $model)
            ->with('deletable', $deletable);
    }

    public function update(Request $request, $id = null)
    {
        if ($request->has('id')) {
            $input = $request->all();
            $model = TournamentRepository::read($input['id']);
            if (!$model) {
                abort(404);
            }

            $game = $model->game;
            if (empty($input['prize']))
                $input['prize'] = 0;

            $validator = Validator::make($input, TournamentRepository::getUpdateValidationRules($model));
            if (!$validator->fails()) {

                try {
                    $repo = new TournamentRepository($model);
                    $repo->update($input);
                } catch (QueryException $ex) {
                    return redirect()
                        ->back()
                        ->with('model', $model)
                        ->with('game', $model->game)
                        ->withErrors(new MessageBag([$ex->getMessage()]));
                }

                return redirect()
                    ->route('back.tournaments.index', ['game' => $game])
                    ->with('status', 'success')
                    ->with('message', sprintf('Tournament %s was updated.', $model->name));
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('game', $game)
                ->with('model', $model)
                ->withErrors($validator->errors());

        }

        $model = TournamentRepository::read($id);
        if (!$model) {
            abort(404);
        }

        return view('tournament.update', ['model' => $model, 'game' => $model->game]);
    }
}
