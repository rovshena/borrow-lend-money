<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $settings = Setting::all(['id', 'key', 'description', 'status']);
            return DataTables::of($settings)
                ->editColumn('status', function ($row) {
                    return $row->status_badge;
                })
                ->addColumn('actions', function ($row) {
                    $view = '<a href="' . route('admin.settings.show', $row) . '" class="btn btn-subtle-primary btn-sm mr-2"><i class="fas fa-eye fa-fw"></i></a>';
                    $edit = '<a href="' . route('admin.settings.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    return $view . $edit;
                })
                ->rawColumns(['actions', 'status'])
                ->toJson();
        }

        return view('admin.setting.index');
    }

    public function show(Setting $setting)
    {
        return view('admin.setting.view', ['setting' => $setting]);
    }

    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        if ($setting->update($request->validated())) {
            return redirect()->route('admin.settings.index')->with('success', 'The setting updated successfully!');
        } else {
            return back()->with('error', 'Can not update the setting!');
        }
    }
}
