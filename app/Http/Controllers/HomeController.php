<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', ['home_page_title', 'home_page_excerpt'])->get();
        $announcements = Announcement::with(['comments', 'country', 'masterComments'])
            ->select(['id', 'title', 'content', 'company', 'type', 'country_id', 'state_id', 'created_at'])
            ->latest()
            ->paginate(12, ['*'], __('страница'))
            ->onEachSide(2);
        return view('visitor.index', compact(['announcements', 'settings']));
    }

    public function show(Announcement $announcement, $slug = "")
    {
        if ($slug !== $announcement->slug) {
            return redirect()->route('announcement.show', [$announcement->id, $announcement->slug]);
        }

        return view('visitor.announcement.show', ['announcement' => $announcement->load(['comments', 'comments.comments'])]);
    }

    public function category($category, $country_id = '', $state_id = '')
    {
        $categories = ['borrow-money', 'lend-money', 'geo'];
        $announcements = [];
        $settings = [];
        if (in_array($category, $categories)) {
            if ($category == 'borrow-money') {
                $announcements = Announcement::with(['comments', 'country', 'state'])
                    ->select(['id', 'title', 'content', 'company', 'type', 'country_id', 'state_id', 'created_at'])
                    ->where('type', Announcement::TYPE_BORROW)
                    ->latest()
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'borrow_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'borrow_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'borrow_money_footer_code')->firstOrFail();
            } elseif ($category == 'lend-money') {
                $announcements = Announcement::with(['comments', 'country', 'state'])
                    ->select(['id', 'title', 'content', 'company', 'type', 'country_id', 'state_id', 'created_at'])
                    ->where('type', Announcement::TYPE_LEND)
                    ->latest()
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'lend_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'lend_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'lend_money_footer_code')->firstOrFail();
            }
        } else {
            return abort(404);
        }

        return view('visitor.home.category', [
            'announcements' => $announcements,
            'settings' => $settings
        ]);
    }

    public function creditCalculator()
    {
        $credit_calculator = Setting::where('key', 'credit_calculator')->firstOrFail();
        return view('visitor.home.credit-calculator', compact('credit_calculator'));
    }
}
