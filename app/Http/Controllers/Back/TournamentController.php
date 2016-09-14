<?php
namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Repositories\TournamentRepository;
use Illuminate\Http\Request;
use Validator;

class TournamentController extends BaseController
{
    public function data(Request $request)
    {
        $sort = !empty($request->input('sort')) ? $request->input('sort') : 'name';
        $order = !empty($request->input('order')) ? $request->input('order') : 'asc';

        return response()->json(TournamentRepository::search($request->input('search'), $sort, $order));
    }

    public function index()
    {
        return view('back.manage_tournaments');
    }

    public function ajaxCreate(Request $request)
    {
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

            return response()->json(new AjaxResponse(false, (string)view('back.create_tour_modal')
                ->with('input', $attributes)
                ->with('errors', $errors)));
        }

        return view('back.create_tour_modal')->with('input', $request->all());
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = TournamentRepository::readWithCount($id);

            if (!$model) {
                abort(404);
            }

            $deletable = $model->matches_count == 0;

            return view('back.delete_tournament')
                ->with('model', $model)
                ->with('deletable', $deletable);
        } else {
            $model = TournamentRepository::readWithCount($request->input('id'));
            if (!$model) {
                abort(404);
            }

            $deletable = $model->matches_count == 0;

            if (!$deletable) {
                return view('back.delete_tournament')
                    ->with('model', $model)
                    ->with('deletable', $deletable);
            }

            $model->delete();

            return redirect()
                ->route('back.tournament.index')
                ->with('status', 'success')
                ->with('message', trans('success.updated', ['model' => trans('contents.tournament'), 'label' => $model->getAttribute('name')]));
        }
    }

    public function update(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = TournamentRepository::read($id);
            if (!$model) {
                abort(404);
            }

            return view('back.update_tournament')->with('model', $model);
        } else {
            $attributes = $request->all();
            $model = TournamentRepository::read($attributes['id']);
            if (!$model) {
                abort(404);
            }

            $validator = Validator::make($attributes, TournamentRepository::getUpdateValidationRules($model));
            if ($validator->fails()) {
                return view('back.update_tournament')
                    ->with('model', $attributes)
                    ->with('errors', $validator->errors());
            } else {
                $repo = new TournamentRepository($model);
                $repo->update($attributes);

                return redirect()
                    ->route('back.tournament.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.updated', ['model' => trans('contents.tournament'), 'label' => $model->getAttribute('name')]));
            }
        }
    }
}