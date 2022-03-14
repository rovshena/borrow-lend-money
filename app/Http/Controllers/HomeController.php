<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Country;
use App\Models\Setting;
use App\Models\State;
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
        $settings = [];
        if (in_array($category, $categories)) {
            $query = Announcement::with(['comments', 'country', 'state'])
                ->select(['id', 'title', 'content', 'company', 'type', 'country_id', 'state_id', 'is_vip', 'created_at']);
            if ($category == 'borrow-money') {
                $announcements = $query
                    ->where('type', Announcement::TYPE_BORROW)
                    ->orderBy('is_vip')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'borrow_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'borrow_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'borrow_money_footer_code')->firstOrFail();
            } elseif ($category == 'lend-money') {
                $announcements = $query
                    ->where('type', Announcement::TYPE_LEND)
                    ->orderBy('is_vip')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'lend_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'lend_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'lend_money_footer_code')->firstOrFail();
            } else {
                $country = Country::findOrFail($country_id);
                if (!empty($state_id)) {
                    $state = $country->states()->where('id', $state_id)->firstOrFail();
                    $announcements = $query
                        ->where('country_id', $country_id)
                        ->where('state_id', $state_id)
                        ->orderBy('is_vip')->orderBy('created_at', 'desc')
                        ->paginate(12, ['*'], __('страница'))
                        ->onEachSide(2);
                    $settings['title'] = Setting::where('key', 'category_state_title')->firstOrFail();
                    $settings['title']->value = str_replace('{{country}}', $country->name, $settings['title']->value);
                    $settings['title']->value = str_replace('{{state}}', $state->name, $settings['title']->value);
                    $settings['content'] = Setting::where('key', 'category_state_content')->firstOrFail();
                    $settings['content']->value = str_replace('{{country}}', $country->name, $settings['content']->value);
                    $settings['content']->value = str_replace('{{state}}', $state->name, $settings['content']->value);
                    $settings['header'] = Setting::where('key', 'category_state_header_code')->firstOrFail();
                    $settings['footer'] = Setting::where('key', 'category_state_footer_code')->firstOrFail();
                } else {
                    $announcements = $country->states()
                        ->has('announcements')
                        ->paginate(24, ['*'], __('страница'))
                        ->onEachSide(2);
                    $settings['title'] = Setting::where('key', 'category_country_title')->firstOrFail();
                    $settings['title']->value = str_replace('{{country}}', $country->name, $settings['title']->value);
                    $settings['content'] = Setting::where('key', 'category_country_content')->firstOrFail();
                    $settings['content']->value = str_replace('{{country}}', $country->name, $settings['content']->value);
                    $settings['header'] = Setting::where('key', 'category_country_header_code')->firstOrFail();
                    $settings['footer'] = Setting::where('key', 'category_country_footer_code')->firstOrFail();
                }
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
