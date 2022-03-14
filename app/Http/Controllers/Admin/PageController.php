<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Setting::PAGES;

        if ($request->ajax()) {
            return DataTables::of($pages)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.pages.edit', $row['key']) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    return $edit;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.page.index');
    }

    public function edit($page)
    {
        $pages = collect(Setting::PAGES);
        $payload['key'] = $page;
        $payload['settings'] = Setting::where('key', 'like', $page. '%')->orderBy('created_at')->get();
        $payload['title'] = $pages->where('key', $page)->first()['name'];

        return view('admin.page.edit', compact('payload'));
    }

    public function update(PageRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            Setting::where('key', $key)->update([
                'value' => $value,
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Настройка успешно обновлена!');
    }
}
