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
            'cities.slug as city_slug',
            'countries.slug as country_slug',
            'countries.iso2',
        ])
            ->join('countries', function ($join) {
                $join->on('cities.country_id', '=', 'countries.id')
                    ->where('countries.status', 1);
            })
            ->where('cities.status', 1)
            ->orderByRaw('IF(countries.iso2 = "RU", 1, 0) DESC')
            ->orderBy('countries.name', 'asc')
            ->orderBy('cities.name', 'asc')
            ->paginate(40, ['*'])
            ->onEachSide(2);
        return view('visitor.index', compact(['cities', 'settings']));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search', '');
        $countries = Announcement::select(['announcements.id', 'announcements.title', 'announcements.slug', 'countries.name as country', 'cities.name as city'])
            ->join('countries', function ($join) {
                $join->on('countries.id', '=', 'announcements.country_id')
                    ->where('countries.status', 1);
            })
            ->join('cities', function ($join) {
                $join->on('cities.id', '=', 'announcements.city_id')
                    ->where('cities.status', 1);
            })
            ->whereRaw("MATCH(countries.name) AGAINST('*{$keyword}*' IN BOOLEAN MODE)")
            ->get();

        $cities = Announcement::select(['announcements.id', 'announcements.title', 'announcements.slug', 'countries.name as country', 'cities.name as city'])
            ->join('countries', function ($join) {
                $join->on('countries.id', '=', 'announcements.country_id')
                    ->where('countries.status', 1);
            })
            ->join('cities', function ($join) {
                $join->on('cities.id', '=', 'announcements.city_id')
                    ->where('cities.status', 1);
            })
            ->whereRaw("MATCH(cities.name) AGAINST('*{$keyword}*' IN BOOLEAN MODE)")
            ->get();

        $title = Announcement::select(['announcements.id', 'announcements.title', 'announcements.slug', 'countries.name as country', 'cities.name as city'])
            ->join('countries', function ($join) {
                $join->on('countries.id', '=', 'announcements.country_id')
                    ->where('countries.status', 1);
            })
            ->join('cities', function ($join) {
                $join->on('cities.id', '=', 'announcements.city_id')
                    ->where('cities.status', 1);
            })
            ->whereRaw("MATCH(announcements.title) AGAINST('*{$keyword}*' IN BOOLEAN MODE)")
            ->get();

        $all = ($countries->merge($cities))->merge($title);

        $all->map(function ($item) use ($keyword) {
            if (mb_eregi($keyword, $item['title'], $matches)) {
                $item['title'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['title']);
            }
            if (mb_eregi($keyword, $item['city'], $matches)) {
                $item['city'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['city']);
            }
            if (mb_eregi($keyword, $item['country'], $matches)) {
                $item['country'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['country']);
            }
            return $item;
        });

        return $all;
    }

    public function searchCity(Request $request, Country $country)
    {
        $keyword = $request->input('search', '');
        $cities = $country->cities()
            ->enabled()
            ->whereRaw("MATCH(name) AGAINST('*{$keyword}*' IN BOOLEAN MODE)")
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        $cities->map(function ($item) use ($keyword) {
            if (mb_eregi($keyword, $item['name'], $matches)) {
                $item['name'] = mb_eregi_replace($keyword, '<span class="bg-faded-primary">'. $matches[0] .'</span>', $item['name']);
            }
            return $item;
        });

        return $cities;
    }

    public function show(Announcement $announcement)
    {
        if (!$announcement->country->status || !$announcement->city->status) {
            return abort(404);
        }

        return view('visitor.announcement.show', [
            'announcement' => $announcement->load(['comments', 'comments.comments']),
            'comments' => $announcement->masterComments()
                ->with(['comments' => function($query) {
                    $query->orderBy('created_at', 'asc');
                }])
                ->orderBy('created_at', 'asc')
                ->paginate(10, ['*'])
                ->onEachSide(2),
            'header' => Setting::where('key', 'announcement_header_code')->firstOrFail(),
            'footer' => Setting::where('key', 'announcement_footer_code')->firstOrFail(),
        ]);
    }

    public function category($category)
    {
        $categories = ['borrow-money', 'lend-money'];
        $settings = [];
        if (in_array($category, $categories)) {
            $query = Announcement::with(['comments', 'country', 'city'])
                ->select(['id', 'title', 'slug', 'content', 'company', 'type', 'country_id', 'city_id', 'is_vip', 'created_at']);
            if ($category == 'borrow-money') {
                $announcements = $query
                    ->whereRelation('country', 'status', 1)
                    ->whereRelation('city', 'status', 1)
                    ->where('type', Announcement::TYPE_BORROW)
                    ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'])
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'borrow_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'borrow_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'borrow_money_footer_code')->firstOrFail();
            } else {
                $announcements = $query
                    ->whereRelation('country', 'status', 1)
                    ->whereRelation('city', 'status', 1)
                    ->where('type', Announcement::TYPE_LEND)
                    ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'])
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

    public function country($country_slug, $city_slug = '')
    {
        $settings = [];
        $country = Country::enabled()->where('slug', $country_slug)->firstOrFail();
        if (!empty($city_slug)) {
            $city = $country->cities()->enabled()->where('slug', $city_slug)->firstOrFail();
            $announcements = Announcement::with(['comments', 'country', 'city'])
                ->select(['id', 'title', 'slug', 'content', 'company', 'type', 'country_id', 'city_id', 'is_vip', 'created_at'])
                ->where('country_id', $country->id)
                ->where('city_id', $city->id)
                ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                ->paginate(12, ['*'])
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
                ->enabled()
                ->paginate(24, ['*'])
                ->onEachSide(2);
            $settings['title'] = Setting::where('key', 'category_country_title')->firstOrFail();
            $settings['title']->value = str_replace('{{country}}', $country->name, $settings['title']->value);
            $settings['content'] = Setting::where('key', 'category_country_content')->firstOrFail();
            $settings['content']->value = str_replace('{{country}}', $country->name, $settings['content']->value);
            $settings['header'] = Setting::where('key', 'category_country_header_code')->firstOrFail();
            $settings['footer'] = Setting::where('key', 'category_country_footer_code')->firstOrFail();
        }

        return view('visitor.home.country', [
            'announcements' => $announcements,
            'settings' => $settings,
            'country' => $country,
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
        return redirect()->route('announcement.show', $announcement->slug)->with('success', 'Ваш комментарий успешно добавлен.');
    }

    public function reply(ReplyCommentRequest $request, Announcement $announcement, Comment $comment)
    {
        $validated = $request->validated();
        $validated['parent_id'] = $comment->id;
        $announcement->comments()->create($validated);
        return redirect()->route('announcement.show', $announcement->slug)
            ->with('success', 'Ваш ответ на комментарий '. $comment->name .' успешно добавлен!');
    }
}
