<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\AdminProfileRequest;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.admin.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user('admin');
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return redirect()->route('admin.index')->with('success', 'Your password has been changed successfully!');
        } else {
            return back()->with('error', 'Can not change the password!');
        }
    }

    public function edit()
    {
        return view('auth.admin.profile');
    }

    public function update(AdminProfileRequest $request)
    {
        if ($request->user('admin')->update($request->validated())) {
            return redirect()->route('admin.profile')->with('success', 'Your profile has been updated successfully!');
        } else {
            return back()->with('error', 'Can not update your profile!');
        }
    }
}
