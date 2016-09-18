<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 03/09/2016
 * Time: 00:12
 */
namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller as BaseController;
use App\Repositories\MatchRepository;
use App\Repositories\OpponentRepository;
use App\Repositories\TournamentRepository;
use Illuminate\Http\Request;
use Setting;
use Validator;

class MatchController extends BaseController
{
    public function data(Request $request)
    {
        $params = $this->retrieveSortParams($request, ['sort'=>'schedule', 'order'=>'desc']);

        return response()->json(MatchRepository::query($request->input('search'), $params['sort'], $params['order']));
    }

    public function index()
    {
        return view('match.manage_matches');
    }

    public function create(Request $request)
    {
        // Get select lists
        $tournaments = TournamentRepository::getList();
        $opponents = OpponentRepository::getList();

        if (!empty($request->all())) {
            $attributes = $request->all();
            $validator = Validator::make($attributes, MatchRepository::getCreateValidationRules());
            if (!$validator->fails()) {
                $match = MatchRepository::create($attributes);

                // Set flag to send fixture today
                Setting::set('fixtures_send_today', 1);

                return redirect()
                    ->route('back.match.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.created', ['model' => trans('contents.match'), 'label' => $match->getAttribute('formatted_schedule')]));
            }

            return view('match.create_match')
                ->with('model', $attributes)
                ->with('errors', $validator->errors())
                ->with('tournaments', $tournaments)
                ->with('opponents', $opponents);
        }

        return view('match.create_match')
            ->with('model', $request->all())
            ->with('tournaments', $tournaments)
            ->with('opponents', $opponents);
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $match = MatchRepository::read($id);

            if (!$match) {
                abort(404);
            }

            return view('match.delete_match')->with('model', array_merge($match->getAttributes(), ['formatted_schedule' => $match->getAttribute('formatted_schedule')]));
        }

        $match = MatchRepository::read($request->input('id'));
        if (!$match) {
            abort(404);
        }

        $match->delete();

        return redirect()
            ->route('back.match.index')
            ->with('status', 'success')
            ->with('message', trans('success.updated', ['model' => trans('contents.match'), 'label' => $match->getAttribute('formatted_schedule')]));
    }

    public function update(Request $request, $id = null)
    {
        $tournaments = TournamentRepository::getList();
        $opponents = OpponentRepository::getList();

        if (empty($request->all())) {
            $match = MatchRepository::read($id);
            if (!$match) {
                abort(404);
            }

            return view('match.update_match')
                ->with('model', $match)
                ->with('tournaments', $tournaments)
                ->with('opponents', $opponents);
        } else {
            $attributes = $request->all();
            $match = MatchRepository::read($attributes['id']);
            if (!$match) {
                abort(404);
            }

            $validator = Validator::make($attributes, MatchRepository::getUpdateValidationRules($match));
            if ($validator->fails()) {
                return view('match.update_match')
                    ->with('model', $attributes)
                    ->with('errors', $validator->errors())
                    ->with('tournaments', $tournaments)
                    ->with('opponents', $opponents);
            }

            $repo = new MatchRepository($match);
            $repo->update($attributes);

            return redirect()
                ->route('back.match.index')
                ->with('status', 'success')
                ->with('message', trans('success.delete', ['model' => trans('contents.match'), 'label' => $match->getAttribute('formatted_schedule')]));
        }
    }
}
