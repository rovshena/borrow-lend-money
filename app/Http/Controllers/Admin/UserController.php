<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all(['id', 'username', 'name']);
            return DataTables::of($users)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.users.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.users.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $row->username == 'administrator' ? '' : ($edit . $delete);
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($request->password);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно создан!');
    }

    public function edit(User $user)
    {
        if ($user->username == 'administrator') {
            return redirect()->back()->with('error', 'Нельзя редактировать администратора!');
        }

        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        if ($user->username == 'administrator') {
            return redirect()->back()->with('error', 'Нельзя редактировать администратора!');
        }

        $user->username = $request->username;
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлен!');
        } else {
            return back()->with('error', 'Не могу обновить данные пользователя!');
        }
    }

    public function destroy(User $user)
    {
        if ($user->username == 'administrator') {
            return response()->json(['error' => 'Нельзя удалять администратора!']);
        }

        if ($user->delete()) {
            return response()->json(['success' => 'Пользователь успешно удален!']);
        } else {
            return response()->json(['error' => 'Не могу удалить пользователя!']);
        }
    }
}
