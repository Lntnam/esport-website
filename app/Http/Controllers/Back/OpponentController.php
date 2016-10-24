<?php
namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Opponent;
use App\Repositories\OpponentRepository;
use App\Traits\GameController;
use Illuminate\Http\Request;
use Validator;

class OpponentController extends BaseController
{
    use GameController;

    /**
     * Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data($game, Request $request)
    {
        $this->validateGame($game);
        $params = $this->retrieveSortParams($request);

        return response()->json(OpponentRepository::search($request->input('search'), $game, $params['sort'], $params['order']));
    }

    public function index($game)
    {
        $this->validateGame($game);

        return view('opponent.manage', ['game' => $game]);
    }

    /**
     * Ajax call
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function ajaxCreate($game, Request $request)
    {
        $this->validateGame($game);
        $input = $request->all();
        if ($request->has('game')) {
            $validator = Validator::make($input, OpponentRepository::getCreateValidationRules());
            if (!$validator->fails()) {
                try {
                    $tour = OpponentRepository::create($input);
                } catch (QueryException $ex) {
                    $request->flash();

                    return response()->json(new AjaxResponse(false,
                        (string)view('opponent.create_modal', ['game' => $game, 'model' => new Opponent()])
                            ->with('errors', new MessageBag([$ex->getMessage()]))
                    ));
                }

                return response()->json(new AjaxResponse(true, $tour));
            }
            $request->flash();

            return response()->json(new AjaxResponse(false,
                (string)view('opponent.create_modal', ['game' => $game, 'model' => new Opponent()])
                    ->with('errors', $validator->errors())
            ));
        }

        return view('opponent.create_modal', ['game' => $game, 'model' => new Opponent()]);
    }

    public function delete(Request $request, $id = null)
    {
        if ($request->has('id')) {

            $model = OpponentRepository::readWithCount($request->input('id'));
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
                    ->withErrors(['This opponent team cannot be deleted.']);
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
                    ->withErrors(new MessageBag([$ex->getMessage()]));
            }

            return redirect()
                ->route('back.opponents.index', ['game' => $game])
                ->with('status', 'success')
                ->with('message', sprintf('Opponent team %s was deleted.', $name));
        }

        $model = OpponentRepository::readWithCount($id);

        if (!$model) {
            abort(404);
        }

        $deletable = $model->matches_count == 0;

        return view('opponent.delete')
            ->with('model', $model)
            ->with('deletable', $deletable);
    }

    public function update(Request $request, $id = null)
    {
        if ($request->has('id')) {
            $input = $request->all();
            $model = OpponentRepository::read($input['id']);
            if (!$model) {
                abort(404);
            }

            $game = $model->game;

            $validator = Validator::make($input, OpponentRepository::getUpdateValidationRules($model));
            if (!$validator->fails()) {

                try {
                    $repo = new OpponentRepository($model);
                    $repo->update($input);
                } catch (QueryException $ex) {
                    return redirect()
                        ->back()
                        ->with('model', $model)
                        ->with('game', $model->game)
                        ->withErrors(new MessageBag([$ex->getMessage()]));
                }

                return redirect()
                    ->route('back.opponents.index', ['game' => $game])
                    ->with('status', 'success')
                    ->with('message', sprintf('Opponent team %s was updated.', $model->name));
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('game', $game)
                ->with('model', $model)
                ->withErrors($validator->errors());

        }

        $model = OpponentRepository::read($id);
        if (!$model) {
            abort(404);
        }

        return view('opponent.update', ['model' => $model, 'game' => $model->game]);
    }
}
