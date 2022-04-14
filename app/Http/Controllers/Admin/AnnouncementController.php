<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $announcements = Announcement::all(['id', 'country_id', 'city_id', 'title', 'is_vip', 'type']);
            return DataTables::of($announcements)
                ->editColumn('is_vip', function ($row) {
                    if ($row->is_vip == 1) {
                        return '<i class="fas fa-star text-warning"></i>';
                    }
                    return '';
                })
                ->editColumn('type', function ($row) {
                    if ($row->type == Announcement::TYPE_BORROW) {
                        return 'Возьму деньги';
                    }
                    return 'Дам деньги';
                })
                ->editColumn('country_id', function ($row) {
                    return $row->country->name;
                })
                ->editColumn('city_id', function ($row) {
                    return $row->city->name;
                })
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.announcements.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    return $edit;
                })
                ->rawColumns(['actions', 'is_vip'])
                ->toJson();
        }

        return view('admin.announcement.index');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', [
            'announcement' => $announcement->load(['country', 'city'])
        ]);
    }

    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        if ($announcement->update($request->validated())) {
            return redirect()->back()->with('success', 'Объявление успешно обновлено!');
        } else {
            return back()->with('error', 'Не могу обновить объявление!');
        }
    }
}
