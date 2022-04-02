<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $comments = Comment::all(['id', 'name', 'email', 'content']);
            return DataTables::of($comments)
                ->editColumn('name', function ($row) {
                    return filled($row->name) ? $row->name : 'Аноним';
                })
                ->editColumn('content', function ($row) {
                    return Str::limit($row->content, 200);
                })
                ->addColumn('actions', function ($row) {
                    $view = '<a href="' . route('admin.comments.show', $row) . '" class="btn btn-subtle-primary btn-sm mr-2"><i class="fas fa-eye fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.comments.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $view . $delete;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.comment.index');
    }

    public function show(Comment $comment)
    {
        return view('admin.comment.view', ['comment' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        $comment->comments()->delete();
        if ($comment->delete()) {
            return response()->json(['success' => 'Комментарий успешно удалено!']);
        } else {
            return response()->json(['error' => 'Не могу удалить комментарий!']);
        }
    }
}
