<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Models\State;

class StateObserver
{
    public function updated(State $state)
    {
        if (!app()->runningInConsole()) {
            Announcement::where('state_id', $state->id)->update([
                'state_name' => $state->name
            ]);
        }
    }
}
