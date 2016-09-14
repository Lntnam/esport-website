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
}