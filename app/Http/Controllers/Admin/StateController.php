<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Traits\UploadImages;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    use UploadImages;

    protected $imagesFolder = 'news';

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $news = News::all(['id', 'title_tk', 'title_ru', 'status']);
            return DataTables::of($news)
                ->editColumn('status', function ($row) {
                    return $row->status_badge;
                })
                ->addColumn('actions', function ($row) {
                    $view = '<a href="' . route('admin.news.show', $row) . '" class="btn btn-subtle-primary btn-sm mr-2"><i class="fas fa-eye fa-fw"></i></a>';
                    $edit = '<a href="' . route('admin.news.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.news.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $view . $edit . $delete;
                })
                ->rawColumns(['status', 'actions'])
                ->toJson();
        }

        return view('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request)
    {
        $news = News::create(Arr::except($request->validated(), ['status', 'image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $filename = $this->uploadImages($request->file('image'));

            $news->update(['image' => $filename]);
        }

        return redirect()->route('admin.news.index')->with('success', __('Täzelik üstünlikli goşuldy.'));
    }

    public function show(News $news)
    {
        return view('admin.news.view', ['news' => $news]);
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', ['news' => $news]);
    }

    public function update(NewsRequest $request, News $news)
    {
        if ($news->update(Arr::except($request->validated(), 'image'))) {

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $filename = $this->uploadImages($request->file('image'));

                $news->update(['image' => $filename]);

                if ($request->filled('old_file')) {
                    $this->removeOldFiles($request->old_file);
                }
            }

            return redirect()->route('admin.news.index')->with('success', __('Täzelik üstünlikli üýtgedildi.'));
        } else {
            return back()->with('error', __('Täzelik üýtgedilmedi.'));
        }
    }

    public function destroy(Request $request, News $news)
    {
        if ($request->ajax()) {

            $image = filled($news->image) ? $news->image : null;

            if ($news->delete()) {

                if ($image !== null) {
                    $this->removeOldFiles($image);
                }

                return response()->json(['success' => __('Täzelik üstünlikli pozuldy.')]);
            } else {
                return response()->json(['error' => __('Täzelik pozulmady.')]);
            }
        } else {
            return response()->json(['error' => __('Rugsat berilmeýär.')]);
        }
    }
}
