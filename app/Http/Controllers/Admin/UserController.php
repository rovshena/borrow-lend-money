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
            $users = User::all(['id', 'username', 'name', 'type']);
            return DataTables::of($users)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.users.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.users.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $row->username == 'administrator' ? '' : ($edit . $delete);
                })
                ->editColumn('type', function ($row) {
                    if ($row->type === User::TYPE_ADMIN) {
                        return '<span class="badge badge-success">admin</span>';
                    } else {
                        return 'user';
                    }
                })
                ->rawColumns(['type', 'actions'])
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
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'type' => User::TYPE_ADMIN,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'The user created successfully!');
    }

    public function edit(User $user)
    {
        if ($user->username == 'administrator') {
            return redirect()->back()->with('error', 'You can not edit the administrator!');
        }

        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        if ($user->username == 'administrator') {
            return redirect()->back()->with('error', 'You can not edit the administrator!');
        }

        $user->username = $request->username;
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            return redirect()->route('admin.users.index')->with('success', 'The user updated successfully!');
        } else {
            return back()->with('error', 'Can not update the user details!');
        }
    }

    public function destroy(User $user)
    {
        if ($user->username == 'administrator') {
            return response()->json(['error' => 'You can not delete the administrator!']);
        }

        if ($user->delete()) {
            return response()->json(['success' => 'The user deleted successfully!']);
        } else {
            return response()->json(['error' => 'Can not delete the user!']);
        }
    }
}
