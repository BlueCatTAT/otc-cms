<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\Role;
use OtcCms\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Factory as Validator;

class CmsUserController extends Controller
{
    public function index()
    {
        $userList = User::all();
        $userList = $userList->filter(function($user) {
            return $user->id != Auth::id();
        });
        return view('cmsuser.index', [
            'userList' => $userList,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $roleList = Role::all();
        if (empty($user)) {
            redirect('cms_user_list');
        }
        return view('cmsuser.show', [
            'user' => $user,
            'roles' => $roleList,
        ]);
    }

    public function update($id, Request $request, Validator $validator)
    {
        $user = User::find($id);
        $role = Role::find($request->get('roleId'));
        if (empty($user)) {
            redirect('cms_user_list');
        }
        if (empty($role)) {
            redirect('cms_user_detail', [$user->id]);
        }
        if (!$user->getRole() || $user->getRole()->id != $role->id) {
            $user->attachRole($role);
        }
        $v = $validator->make($request->all(), [
            'password' => 'required|confirmed'
        ]);
        if ($v->fails()) {
            redirect('cms_user_detail', [$user->id])->with('errors', $v->errors());
        }
        $user->password = bcrypt($request->input('password'));
        try {
            $user->save();
            redirect('cms_user_detail', [$user->id])->with('updateSuccess', true);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'userId' => $user->id,
                'roleId' => $request->input('roleId'),
                'context' => __CLASS__.':'.__METHOD__,
            ]);
            redirect('cms_user_detail', [$user->id])->with('updateSuccess', false);
        }
    }
}
