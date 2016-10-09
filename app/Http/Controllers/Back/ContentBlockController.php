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
        return response()->json(ContentBlockRepository::query());
    }

    public function index()
    {
        return view('content_block.index');
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $model = ContentBlockRepository::read($id);

            if (!$model) {
                abort(404);
            }

            return view('content_block.delete')->with('model', $model);
        }

        $model = ContentBlockRepository::read($request->input('id'));
        if (!$model) {
            abort(404);
        }

        $model->delete();

        return redirect()
            ->route('back.content_block.index')
            ->with('status', 'success')
            ->with('message', sprintf('Content block %s/%s was deleted.', $model->view, $model->key));
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
