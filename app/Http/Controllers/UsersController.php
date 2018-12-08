<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    //展示页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    //编辑页面
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //更新入库  
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('user.show', $user->id)->with('success', '个人资料编辑成功');
    }
}
