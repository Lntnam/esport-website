<?php

namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Repositories\ContentBlockRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Validator;

class ContentBlockController extends BaseController
{
    /**
     * Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $params = $this->retrieveSortParams($request, ['sort' => 'view,key', 'order' => 'asc']);

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

    public function startEdit()
    {
        session(['admin_edit_page' => true]);

        return redirect()->route('front.home');
    }

    public function stopEdit(Request $request)
    {
        $request->session()
                ->forget('admin_edit_page');

        return redirect()->route('back.content_block.index');
    }

    /**
     * Ajax call
     *
     * @param Request $request
     * @param $view
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request, $view)
    {
        try {
            $key = $request->input('editorID');
            $block = ContentBlockRepository::loadOne($view, $key);
            if (empty($block)) {
                $block = new ContentBlockRepository(ContentBlockRepository::create([
                    'key'         => $key,
                    'view'        => $view,
                    'description' => 'Auto created.',
                ]));
            }
            $block->saveContent($request->input('editabledata'));
        } catch (QueryException $exception) {
            return response()->json(new AjaxResponse(false, $exception->getMessage()));
        }

        return response()->json(new AjaxResponse(true));
    }
}
