<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller as BaseController;
use App\Repositories\ContentBlockRepository;
use Illuminate\Http\Request;
use Setting;
use Validator;

class ContentBlockController extends BaseController
{
    public function data(Request $request)
    {
        $params = $this->retrieveSortParams($request, ['sort'=>'key', 'order'=>'asc']);

        return response()->json(ContentBlockRepository::query($params['sort'], $params['order']));
    }

    public function index()
    {
        return view('content_block.index');
    }

    public function create(Request $request)
    {
        if (!empty($request->all())) {
            $attributes = $request->all();
            $validator = Validator::make($attributes, ContentBlockRepository::getCreateValidationRules());
            if (!$validator->fails()) {
                $model = ContentBlockRepository::create($attributes);

                return redirect()
                    ->route('back.content_block.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.created', ['model' => trans('contents.content_block'), 'label' => $model->getAttribute('key')]));
            }

            return view('content_block.create')
                ->with('model', $attributes)
                ->with('errors', $validator->errors());
        }

        return view('content_block.create')
            ->with('model', $request->all());
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $match = ContentBlockRepository::read($id);

            if (!$match) {
                abort(404);
            }

            return view('content_block.delete')->with('model', $match->getAttributes());
        }

        $match = ContentBlockRepository::read($request->input('id'));
        if (!$match) {
            abort(404);
        }

        $match->delete();

        return redirect()
            ->route('back.content_block.index')
            ->with('status', 'success')
            ->with('message', trans('success.delete', ['model' => trans('contents.content_block'), 'label' => $match->getAttribute('key')]));
    }
}
