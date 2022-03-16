<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyCommentRequest;
use App\Models\Announcement;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', ['home_page_title', 'home_page_excerpt'])->get();
        $countries = Country::has('announcements')->with(['states' => function($query) {
            $query->has('announcements');
        }])->get(['id', 'name']);
        return view('visitor.index', compact(['countries', 'settings']));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search', '');
        $countries = Announcement::select(['announcements.id', 'announcements.title', 'countries.name as country', 'states.name as state'])
            ->join('countries', 'countries.id', '=', 'announcements.country_id')
            ->join('states', 'states.id', '=', 'announcements.state_id')
            ->where('countries.name', 'like', "%{$keyword}%")
            ->get();

        $countries->map(function ($item) use ($keyword) {
            $item['country'] = str_replace($keyword, '<span class="bg-faded-primary">'. $keyword .'</span>', $item['country']);
            return $item;
        });

        $states = Announcement::select(['announcements.id', 'announcements.title', 'countries.name as country', 'states.name as state'])
            ->join('countries', 'countries.id', '=', 'announcements.country_id')
            ->join('states', 'states.id', '=', 'announcements.state_id')
            ->where('states.name', 'like', "%{$keyword}%")
            ->get();

        $states->map(function ($item) use ($keyword) {
            $item['state'] = str_replace($keyword, '<span class="bg-faded-primary">'. $keyword .'</span>', $item['state']);
            return $item;
        });

        $title = Announcement::select(['announcements.id', 'announcements.title', 'countries.name as country', 'states.name as state'])
            ->join('countries', 'countries.id', '=', 'announcements.country_id')
            ->join('states', 'states.id', '=', 'announcements.state_id')
            ->where('announcements.title', 'like', "%{$keyword}%")
            ->get();

        $title->map(function ($item) use ($keyword) {
            $item['title'] = str_replace($keyword, '<span class="bg-faded-primary">'. $keyword .'</span>', $item['title']);
            return $item;
        });

        return ($countries->merge($states))->merge($title);
    }

    public function show(Announcement $announcement, $slug = "")
    {
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
                    ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
                    ->paginate(12, ['*'], __('страница'))
                    ->onEachSide(2);
                $settings['title'] = Setting::where('key', 'borrow_money_title')->firstOrFail();
                $settings['header'] = Setting::where('key', 'borrow_money_header_code')->firstOrFail();
                $settings['footer'] = Setting::where('key', 'borrow_money_footer_code')->firstOrFail();
            } elseif ($category == 'lend-money') {
                $announcements = $query
                    ->where('type', Announcement::TYPE_LEND)
                    ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
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
                        ->orderBy('is_vip', 'desc')->orderBy('created_at', 'desc')
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
