<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\Role;
use OtcCms\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Factory as Validator;
use Log;

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
        $role = Role::find($request->input('roleId'));
        if (empty($user)) {
            return redirect('cms_user_list');
        }
        if (empty($role)) {
            return redirect()->back();
        }

        if (!$user->getRole()) {
            $user->attachRole($role);
        } elseif ($user->getRole() && $user->getRole()->id != $role->id) {
            $user->detachRole($user->getRole());
            $user->attachRole($role);
        }


        $password = $request->input('password');
        if (empty($password)) {
            return redirect()->back()->with('message', '更新成功');
        }

        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);

        $user->password = bcrypt($password);
        try {
            $user->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'userId' => $user->id,
                'roleId' => $request->input('roleId'),
                'context' => __CLASS__.':'.__METHOD__,
            ]);
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('message', '更新成功');
    }
}
