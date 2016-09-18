<?php
namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Repositories\OpponentRepository;
use Illuminate\Http\Request;
use Validator;

class OpponentController extends BaseController
{
    public function data(Request $request)
    {
        $params = $this->retrieveSortParams($request);

        return response()->json(OpponentRepository::search($request->input('search'), $params['sort'], $params['order']));
    }

    public function index()
    {
        return view('opponent.manage_opponents');
    }

    public function ajaxCreate(Request $request)
    {
        if (!empty($request->all())) {
            $validator = Validator::make($request->all(), OpponentRepository::getCreateValidationRules());
            if (!$validator->fails()) {
                $team = OpponentRepository::create($request->all());

                return response()->json(new AjaxResponse(true, $team));
            }

            return response()->json(new AjaxResponse(false, (string)view('opponent.create_opponent_modal')
                ->with('input', $request->all())
                ->with('errors', $validator->errors())));
        }

        return view('opponent.create_opponent_modal')->with('input', $request->all());
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = OpponentRepository::readWithCount($id);

            if (!$model) {
                abort(404);
            }

            $deletable = $model->matches_count == 0;

            return view('opponent.delete_opponent')
                ->with('model', $model)
                ->with('deletable', $deletable);
        }

        $model = OpponentRepository::readWithCount($request->input('id'));
        if (!$model) {
            abort(404);
        }

        $deletable = $model->matches_count == 0;

        if (!$deletable) {
            return view('opponent.delete_opponent')
                ->with('model', $model)
                ->with('deletable', $deletable);
        }

        $model->delete();

        return redirect()
            ->route('back.opponent.index')
            ->with('status', 'success')
            ->with('message', trans('success.delete', ['model' => trans('contents.opponent'), 'label' => $model->getAttribute('name')]));
    }

    public function update(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = OpponentRepository::read($id);
            if (!$model) {
                abort(404);
            }

            return view('opponent.update_opponent')->with('model', $model);
        } else {
            $attributes = $request->all();
            $model = OpponentRepository::read($attributes['id']);
            if (!$model) {
                abort(404);
            }

            $validator = Validator::make($attributes, OpponentRepository::getUpdateValidationRules($model));
            if ($validator->fails()) {
                return view('opponent.update_opponent')
                    ->with('model', $attributes)
                    ->with('errors', $validator->errors());
            }

            $repo = new OpponentRepository($model);
            $repo->update($attributes);

            return redirect()
                ->route('back.opponent.index')
                ->with('status', 'success')
                ->with('message', trans('success.updated', ['model' => trans('contents.opponent'), 'label' => $model->getAttribute('name')]));
        }
    }
}
