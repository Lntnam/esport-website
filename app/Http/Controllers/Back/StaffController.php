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
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends BaseController
{
    public function data(Request $request)
    {
        $sort = !empty($request->input('sort')) ? $request->input('sort') : 'name';
        $order = !empty($request->input('order')) ? $request->input('order') : 'asc';

        return response()->json(UserRepository::query($sort, $order));
    }

    public function index()
    {
        return view('back.manage_staffs');
    }

    public function create(Request $request)
    {
        if (!empty($request->all())) {
            $validator = Validator::make($request->all(), UserRepository::getCreateValidationRules());
            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                UserRepository::create(['name' => $request->input('name'), 'email' => $request->input('email')]);

                return redirect()
                    ->route('back.staff.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.created', ['model' => trans('contents.staff'), 'label' => $request->input('name')]));
            }

            return view('back.create_staff')
                ->with('input', $request->all())
                ->with('errors', $errors);
        }

        return view('back.create_staff')->with('input', $request->all());
    }

    public function delete(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $user = UserRepository::read($id);

            if (!$user || $user->getAttribute('root')) {
                abort(404);
            }

            return view('back.delete_staff')->with('model', $user->getAttributes());
        } else {
            $user = UserRepository::read($request->input('id'));
            if (!$user || $user->getAttribute('root')) {
                abort(404);
            }

            UserRepository::destroy($user->id);

            return redirect()
                ->route('back.staff.index')
                ->with('status', 'success')
                ->with('message', trans('success.deleted', ['model' => trans('contents.staff')]));
        }
    }

    public function restore($id)
    {
        $user = UserRepository::restoreDeleted($id);
        if (!$user) {
            return response()->json(new AjaxResponse(false, trans('validation.not-found', ['model' => 'staff'])));
        }

        return response()->json(new AjaxResponse(true, '', $user));
    }

    public function update(Request $request, $id = null)
    {
        if (empty($request->all())) {
            $user = UserRepository::read($id);
            if (!$user) {
                abort(404);
            }

            return view('back.update_staff')->with('model', $user->getAttributes());
        } else {
            $user = UserRepository::read($request->input('id'));
            if (!$user) {
                abort(404);
            }

            $validator = Validator::make($request->all(), UserRepository::getUpdateValidationRules($user));
            if ($validator->fails()) {
                return view('back.update_staff')
                    ->with('model', $request->all())
                    ->with('errors', $validator->errors());
            } else {
                $repo = new UserRepository($user);
                $repo->update($request->all());

                return redirect()
                    ->route('back.staff.index')
                    ->with('status', 'success')
                    ->with('message', trans('success.updated', ['model' => trans('contents.staff'), 'label' => $user->name]));
            }
        }
    }
}
