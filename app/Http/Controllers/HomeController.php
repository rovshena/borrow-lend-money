<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with(['comments', 'country'])->paginate();
        return view('visitor.index', compact('announcements'));
    }
}
