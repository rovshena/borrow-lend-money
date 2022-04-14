<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return redirect()->route('admin.change-password')->with('success', 'Ваш пароль был успешно изменен!');
        } else {
            return back()->with('error', 'Не могу изменить пароль!');
        }
    }

    public function edit()
    {
        return view('auth.profile');
    }

    public function update(UserProfileRequest $request)
    {
        if ($request->user()->update($request->validated())) {
            return redirect()->route('admin.profile')->with('success', 'Ваш профиль был успешно обновлен!');
        } else {
            return back()->with('error', 'Не могу обновить свой профиль!');
        }
    }
}
