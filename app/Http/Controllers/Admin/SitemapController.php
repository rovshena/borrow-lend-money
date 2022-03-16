<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Compatibility;
use App\Models\Country;
use App\Models\Translation;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke()
    {
        set_time_limit(300);

        $sitemap = Sitemap::create();

        $sitemap->add(Url::create(route('index'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('privacy'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('terms'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('about'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('contact'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('borrow.money'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('lend.money'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );
        $sitemap->add(Url::create(route('credit-calculator'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );

        $sitemap->add(Url::create(route('category', 'borrow-money'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );

        $sitemap->add(Url::create(route('category', 'lend-money'))
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.1)
        );

        $countries = Country::has('announcements')->with(['states' => function($query) {
            $query->has('announcements');
        }])->get(['id']);

        if ($countries->isNotEmpty()) {
            foreach ($countries as $country) {
                $sitemap->add(Url::create(route('category', ['geo', $country->id]))
                    ->setLastModificationDate(Carbon::today())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.1)
                );

                if ($country->states->isNotEmpty()) {
                    foreach ($country->states as $state) {
                        $sitemap->add(Url::create(route('category', ['geo', $country->id, $state->id]))
                            ->setLastModificationDate(Carbon::today())
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.1)
                        );
                    }
                }
            }
        }

        $announcements = Announcement::all(['id', 'title']);
        foreach ($announcements as $announcement) {
            $sitemap->add(Url::create(route('announcement.show', [$announcement->id, $announcement->slug]))
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1)
            );
        }

        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        if (file_exists($path)) {
            $file_content = file_get_contents($path);
            if (strlen($file_content)) {
                return redirect()->route('admin.index')->with('success', 'The sitemap created successfully!');
            } else {
                return redirect()->route('admin.index')->with('error', 'The sitemap file created but the content is empty!');
            }
        }

        return redirect()->route('admin.index')->with('error', 'The sitemap could not created!');

    }
}
