<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Models\Country;
use App\Models\State;

class AnnouncementObserver
{
    public function created(Announcement $announcement)
    {
        if (!app()->runningInConsole()) {
            $country = Country::find($announcement->country_id);
            $state = State::find($announcement->state_id);
            $announcement->update([
                'country_name'=> $country->name,
                'state_name' => $state->name
            ]);
        }
    }
}
