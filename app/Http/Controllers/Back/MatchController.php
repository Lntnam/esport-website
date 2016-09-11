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
use Illuminate\Support\Facades\Validator;

class MatchController extends BaseController
{
    public function data(Request $request)
    {
        $sort = !empty($request->input('sort')) ? $request->input('sort') : 'schedule';
        $order = !empty($request->input('order')) ? $request->input('order') : 'desc';

        return response()->json(MatchRepository::query($request->input('search'), $sort, $order));
    }

    public function index()
    {
        return view('back.manage_matches');
    }

    public function create(Request $request)
    {
        // Get select lists
        $tournaments = TournamentRepository::getList();
        $opponents = OpponentRepository::getList();

        if (!empty($request->all())) {
            $attributes = $request->all();

            $validator = Validator::make($attributes, MatchRepository::getCreateValidationRules());
            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                $match = MatchRepository::create($attributes);
                return redirect()->route('back.match.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.created', ['model' => 'match', 'label' => $match->getAttribute('formatted_schedule')]));
            }

            return view('back.create_match')
                ->with('model', $attributes)
                ->with('errors', $errors)
                ->with('tournaments', $tournaments)
                ->with('opponents', $opponents);
        }

        return view('back.create_match')
            ->with('model', $request->all())
            ->with('tournaments', $tournaments)
            ->with('opponents', $opponents);
    }

    public function delete(Request $request, $id=null)
    {
        if (empty($request->all())) {
            $match = MatchRepository::read($id);

            if (!$match) {
                abort(404);
            }
            return view('back.delete_match')->with('model', array_merge($match->getAttributes(), ['formatted_schedule'=>$match->getAttribute('formatted_schedule')]));
        }
        else {
            $match = MatchRepository::read($request->input('id'));
            if (!$match) {
                abort(404);
            }

            $match->delete();

            return redirect()->route('back.match.index')
                ->with('status', 'success')
                ->with('message', trans('success.updated', ['model' => 'match', 'label' => $match->getAttribute('formatted_schedule')]));
        }
    }

    public function update(Request $request, $id=null)
    {
        $opponents = OpponentRepository::getList();

        if (empty($request->all())) {
            $match = MatchRepository::read($id);
            if (!$match) {
                abort(404);
            }
            return view('back.update_match')
                ->with('model', array_merge($match->getAttributes(), ['formatted_schedule'=>$match->getAttribute('formatted_schedule')]))
                ->with('opponents', $opponents);
        }
        else {
            $attributes = $request->all();
            $match = MatchRepository::read($attributes['id']);
            if (!$match) {
                abort(404);
            }

            $validator = Validator::make($attributes, MatchRepository::getUpdateValidationRules($match));
            if ($validator->fails()) {
                return view('back.update_match')
                    ->with('model', array_merge($attributes, ['formatted_schedule'=>$match->getAttribute('formatted_schedule')]))
                    ->with('errors', $validator->errors())
                    ->with('opponents', $opponents);
            }
            else {
                $repo = new MatchRepository($match);
                $repo->update($attributes);

                return redirect()->route('back.match.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.updated', ['model' => 'match', 'label' => $match->getAttribute('formatted_schedule')]));
            }
        }
    }
}