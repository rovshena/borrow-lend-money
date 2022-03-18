<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyCommentRequest;
use App\Models\Announcement;
use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', ['home_page_title', 'home_page_excerpt'])->get();
        $cities = City::select([
            'cities.id as city_id',
            'countries.id as country_id',
            'cities.name as city',
            'countries.name as country',
            'countries.iso2',
        ])
            ->join('countries', 'countries.id', 'cities.country_id')
            ->orderByRaw('IF(countries.iso2 = "RU", 1, 0) DESC')
            ->orderBy('countries.name', 'asc')
            ->orderBy('cities.name', 'asc')
            ->paginate(40, ['*'], __('страница'))
            ->onEachSide(2);
        return view('visitor.index', compact(['cities', 'settings']));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search', '');
        $countries = Announcement::select(['announcements.id', 'announcements.title', 'countries.name as country', 'cities.name as city'])
            ->join('countries', 'countries.id', '=', 'announcements.country_id')
            ->join('cities', 'cities.id', '=', 'announcements.city_id')
            ->where('countries.name', 'like', "%{$keyword}%")
            ->where('cities.status', 1)
            ->get();

        $countries->map(function ($item) use ($keyword) {
            if (mb_eregi($keyword, $item['country'], $matches)) {
                $item['country'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['country']);
            }
            return $item;
        });

        $cities = Announcement::select(['announcements.id', 'announcements.title', 'countries.name as country', 'cities.name as city'])
            ->join('countries', 'countries.id', '=', 'announcements.country_id')
            ->join('cities', 'cities.id', '=', 'announcements.city_id')
            ->where('cities.name', 'like', "%{$keyword}%")
            ->where('cities.status', 1)
            ->get();

        $cities->map(function ($item) use ($keyword) {
            if (mb_eregi($keyword, $item['city'], $matches)) {
                $item['city'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['city']);
            }
            return $item;
        });

        $title = Announcement::select(['announcements.id', 'announcements.title', 'countries.name as country', 'cities.name as city'])
            ->join('countries', 'countries.id', '=', 'announcements.country_id')
            ->join('cities', 'cities.id', '=', 'announcements.city_id')
            ->where('announcements.title', 'like', "%{$keyword}%")
            ->where('cities.status', 1)
            ->get();

        $title->map(function ($item) use ($keyword) {
            if (mb_eregi($keyword, $item['title'], $matches)) {
                $item['title'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['title']);
            }
            return $item;
        });

        return ($countries->merge($cities))->merge($title);
    }

    public function show(Announcement $announcement, $slug = "")
    {
        if (!$announcement->city->status) {
            return abort(404);
        }

        if ($slug !== $announcement->slug) {
            return redirect()->route('announcement.show', [$announcement->id, $announcement->slug]);
        }

        return view('visitor.announcement.show', [
            'announcement' => $announcement->load(['comments', 'comments.comments']),
            'comments' => $announcement->masterComments()
                ->with(['comments' => function($query) {
                    $query->orderBy('created_at', 'asc');
                }])
                ->orderBy('created_at', 'asc')
                ->paginate(10, ['*'], __('страница'))
                ->onEachSide(2),
            'header' => Setting::where('key', 'announcement_header_code')->firstOrFail(),
            'footer' => Setting::where('key', 'announcement_footer_code')->firstOrFail(),
        ]);
    }

    public function category($category, $country_id = '', $city_id = '')
    {
        $categories = ['borrow-money', 'lend-money', 'geo'];
        $settings = [];
        if (in_array($category, $categories)) {
            $query = Announcement::with(['comments', 'country', 'city'])
                ->select(['id', 'title', 'content', 'company', 'type', 'country_id', 'city_id', 'is_vip', 'created_at']);
            if ($category == 'borrow-money') {
                $announcements = $query
                    ->whereRelation('city', 'status', 1)
                    ->where('type', Announcement::TYPE_BORROW)
                    ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'borrow_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'borrow_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'borrow_money_footer_code')->firstOrFail();
            } elseif ($category == 'lend-money') {
                $announcements = $query
                    ->whereRelation('city', 'status', 1)
                    ->where('type', Announcement::TYPE_LEND)
                    ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'lend_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'lend_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'lend_money_footer_code')->firstOrFail();
            } else {
                $country = Country::findOrFail($country_id);
                if (!empty($city_id)) {
                    $city = $country->cities()->where('id', $city_id)->where('status', 1)->firstOrFail();
                    $announcements = $query
                        ->where('country_id', $country_id)
                        ->where('city_id', $city_id)
                        ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                        ->paginate(12, ['*'], __('страница'))
                        ->onEachSide(2);
                    $settings['title'] = Setting::where('key', 'category_city_title')->firstOrFail();
                    $settings['title']->value = str_replace('{{country}}', $country->name, $settings['title']->value);
                    $settings['title']->value = str_replace('{{city}}', $city->name, $settings['title']->value);
                    $settings['content'] = Setting::where('key', 'category_city_content')->firstOrFail();
                    $settings['content']->value = str_replace('{{country}}', $country->name, $settings['content']->value);
                    $settings['content']->value = str_replace('{{city}}', $city->name, $settings['content']->value);
                    $settings['header'] = Setting::where('key', 'category_city_header_code')->firstOrFail();
                    $settings['footer'] = Setting::where('key', 'category_city_footer_code')->firstOrFail();
                } else {
                    $announcements = $country->cities()
                        ->where('status', 1)
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

    public function comment(CommentRequest $request, Announcement $announcement)
    {
        $announcement->masterComments()->create($request->validated());
        return redirect()->route('announcement.show', [$announcement->id, $announcement->slug])->with('success', 'Ваш комментарий успешно добавлен.');
    }

    public function reply(ReplyCommentRequest $request, Announcement $announcement, Comment $comment)
    {
        $validated = $request->validated();
        $validated['parent_id'] = $comment->id;
        $announcement->comments()->create($validated);
        return redirect()->route('announcement.show', [$announcement->id, $announcement->slug])
            ->with('success', 'Ваш ответ на комментарий '. $comment->name .' успешно добавлен!');
    }
}
