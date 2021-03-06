<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    //展示页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    //编辑页面
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //更新入库  
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        // dd($request->avatar);
        $data = $request->all();
        if( $request->avatar )
        {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if( $result )
            {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料编辑成功');
    }
}
