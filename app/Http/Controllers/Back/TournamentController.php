<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 03/09/2016
 * Time: 00:12
 */
namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Repositories\MatchRepository;
use App\Repositories\TournamentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentController extends BaseController
{
    public function ajaxCreate(Request $request) {
        if (!empty($request->all())) {
            $attributes = $request->all();
            if (empty($attributes['prize'])) $attributes['prize'] = 0;

            $validator = Validator::make($attributes, TournamentRepository::getCreateValidationRules());
            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                $tour = TournamentRepository::create($attributes);
                return response()->json(new AjaxResponse(true, $tour));
            }

            return response()->json(new AjaxResponse(false,
                (string) view('back.create_tour_modal')
                ->with('input', $attributes)
                ->with('errors', $errors)
            ));
        }
        return view('back.create_tour_modal')->with('input', $request->all());
    }

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
        // Get tournament list
        $tournaments = TournamentRepository::getList();

        if (!empty($request->all())) {
            $validator = Validator::make($request->all(), MatchRepository::getCreateValidationRules());
            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                $match = MatchRepository::create($request->all());
                return redirect()->route('back.match.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.created', ['model' => 'match', 'label' => $match->opponent->name]));
            }

            return view('back.create_match')
                ->with('input', $request->all())
                ->with('errors', $errors)
                ->with('tournaments', $tournaments);
        }

        return view('back.create_match')
            ->with('input', $request->all())
            ->with('tournaments', $tournaments);
    }

    public function getDelete($id)
    {
        $user = UserRepository::read($id);
        if (!$user || $user->getAttribute('root')) {
            abort(404);
        }
        return view('back.delete_staff')->with('model', $user->getAttributes());
    }

    public function getRestore($id)
    {
        $user = UserRepository::restoreDeleted($id);
        if (!$user) {
            return response()->json(new AjaxResponse(false, trans('validation.not-found', ['model'=>'staff'])));
        }
        return response()->json(new AjaxResponse(true, '', $user));
    }

    public function postDelete(Request $request)
    {
        $user = UserRepository::read($request->input('id'));
        if (!$user || $user->getAttribute('root')) {
            abort(404);
        }

        UserRepository::destroy($user->id);

        return redirect()->route('back.staff.index')
            ->with('status', 'success')
            ->with('message', trans('success.deleted', ['model' => 'staff']));
    }

    public function update(Request $request, $id=null)
    {
        if (empty($request->all())) {
            $user = UserRepository::read($id);
            if (!$user) {
                abort(404);
            }
            return view('back.update_staff')->with('model', $user->getAttributes());
        }
        else {
            $user = UserRepository::read($request->input('id'));
            if (!$user) {
                abort(404);
            }

            $validator = Validator::make($request->all(), UserRepository::getUpdateValidationRules($user));
            if ($validator->fails()) {
                return view('back.update_staff')
                    ->with('model', $request->all())
                    ->with('errors', $validator->errors());
            }
            else {
                $repo = new UserRepository($user);
                $repo->update($request->all());

                return redirect()->route('back.staff.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.updated', ['model' => 'staff', 'label' => $user->name]));
            }
        }
    }
}