<?php
namespace App\Http\Controllers\Back;

use App\AjaxResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Repositories\MatchRepository;
use App\Repositories\OpponentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpponentController extends BaseController
{
    public function ajaxCreate(Request $request) {
        if (!empty($request->all())) {
            $validator = Validator::make($request->all(), OpponentRepository::getCreateValidationRules());
            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                $team = OpponentRepository::create($request->all());
                return response()->json(new AjaxResponse(true, $team));
            }

            return response()->json(new AjaxResponse(false,
                (string) view('back.create_opponent_modal')
                ->with('input', $request->all())
                ->with('errors', $errors)
            ));
        }
        return view('back.create_opponent_modal')->with('input', $request->all());
    }

    public function data(Request $request)
    {
        $sort = !empty($request->input('sort')) ? $request->input('sort') : 'schedule';
        $order = !empty($request->input('order')) ? $request->input('order') : 'desc';

        return response()->json(MatchRepository::query($request->input('search'), $sort, $order));
    }
}