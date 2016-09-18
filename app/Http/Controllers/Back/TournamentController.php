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
        $params = $this->retrieveSortParams($request);

        return response()->json(TournamentRepository::search($request->input('search'), $params['sort'], $params['sort']));
    }

    public function index()
    {
        return view('tournament.manage_tournaments');
    }

    public function ajaxCreate(Request $request)
    {
        if (!empty($request->all())) {
            $attributes = $request->all();
            if (empty($attributes['prize'])) $attributes['prize'] = 0;

            $validator = Validator::make($attributes, TournamentRepository::getCreateValidationRules());
            if (!$validator->fails()) {
                $tour = TournamentRepository::create($attributes);

                return response()->json(new AjaxResponse(true, $tour));
            }

            return response()->json(new AjaxResponse(false, (string)view('tournament.create_tour_modal')
                ->with('input', $attributes)
                ->with('errors', $validator->errors())));
        }

        return view('tournament.create_tour_modal')->with('input', $request->all());
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = TournamentRepository::readWithCount($id);

            if (!$model) {
                abort(404);
            }

            $deletable = $model->matches_count == 0;

            return view('tournament.delete_tournament')
                ->with('model', $model)
                ->with('deletable', $deletable);
        }

        $model = TournamentRepository::readWithCount($request->input('id'));
        if (!$model) {
            abort(404);
        }

        $deletable = $model->matches_count == 0;

        if (!$deletable) {
            return view('tournament.delete_tournament')
                ->with('model', $model)
                ->with('deletable', $deletable);
        }

        $model->delete();

        return redirect()
            ->route('back.tournament.index')
            ->with('status', 'success')
            ->with('message', trans('success.updated', ['model' => trans('contents.tournament'), 'label' => $model->getAttribute('name')]));
    }

    public function update(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = TournamentRepository::read($id);
            if (!$model) {
                abort(404);
            }

            return view('tournament.update_tournament')->with('model', $model);
        } else {
            $attributes = $request->all();
            $model = TournamentRepository::read($attributes['id']);
            if (!$model) {
                abort(404);
            }

            $validator = Validator::make($attributes, TournamentRepository::getUpdateValidationRules($model));
            if ($validator->fails()) {
                return view('tournament.update_tournament')
                    ->with('model', $attributes)
                    ->with('errors', $validator->errors());
            }

            $repo = new TournamentRepository($model);
            $repo->update($attributes);

            return redirect()
                ->route('back.tournament.index')
                ->with('status', 'success')
                ->with('message', trans('success.delete', ['model' => trans('contents.tournament'), 'label' => $model->getAttribute('name')]));
        }
    }
}
