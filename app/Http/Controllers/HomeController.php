<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with(['comments', 'country', 'masterComments'])
            ->select(['id', 'title', 'content', 'company', 'type', 'country_id', 'state_id', 'created_at'])
            ->latest()
            ->paginate(12, ['*'], __('page'))
            ->onEachSide(2);
        return view('visitor.index', compact('announcements'));
    }

    public function show(Announcement $announcement, $slug = "")
    {
        if ($slug !== $announcement->slug) {
            return redirect()->route('announcement.show', [$announcement->id, $announcement->slug]);
        }

        return view('visitor.announcement.show', ['announcement' => $announcement->load(['comments', 'comments.comments'])]);
    }
}
