<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
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

        $countries = Country::with(['cities' => function($query) {
            $query->enabled();
        }])->enabled()->get(['id', 'slug']);

        if ($countries->isNotEmpty()) {
            foreach ($countries as $country) {
                $sitemap->add(Url::create(route('country', $country->slug))
                    ->setLastModificationDate(Carbon::today())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.1)
                );

                if ($country->cities->isNotEmpty()) {
                    foreach ($country->cities as $city) {
                        $sitemap->add(Url::create(route('country', [$country->slug, $city->slug]))
                            ->setLastModificationDate(Carbon::today())
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.1)
                        );

                        if ($city->status && $city->announcements()->exists()) {
                            foreach ($city->announcements as $announcement) {
                                $sitemap->add(Url::create(route('announcement.show', $announcement->slug))
                                    ->setLastModificationDate(Carbon::today())
                                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                                    ->setPriority(0.1)
                                );
                            }
                        }
                    }
                }
            }
        }

        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        if (file_exists($path)) {
            $file_content = file_get_contents($path);
            if (strlen($file_content)) {
                return redirect()->route('admin.index')->with('success', 'The sitemap generated successfully!');
            } else {
                return redirect()->route('admin.index')->with('error', 'The sitemap file created but the content is empty!');
            }
        }

        return redirect()->route('admin.index')->with('error', 'The sitemap could not generated!');

    }
}
