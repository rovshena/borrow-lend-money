<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Models\Country;

class CountryObserver
{
    public function updated(Country $country)
    {
        if (!app()->runningInConsole()) {
            Announcement::where('country_id', $country->id)->update([
                'country_name' => $country->name
            ]);
        }
    }
}
