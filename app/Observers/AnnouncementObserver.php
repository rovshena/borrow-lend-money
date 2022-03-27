<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Traits\Sluggable;

class AnnouncementObserver
{
    use Sluggable;

    public function creating(Announcement $announcement)
    {
        $announcement->slug = $this->generateSlug($this->slug($announcement->title));
    }

    /**
     * Handle the Announcement "created" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function created(Announcement $announcement)
    {
        //
    }

    public function updating(Announcement $announcement)
    {
        $announcement->slug = $this->generateSlug($this->slug($announcement->title), 0, 'update', $announcement->id);
    }

    /**
     * Handle the Announcement "updated" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function updated(Announcement $announcement)
    {
        //
    }

    /**
     * Handle the Announcement "deleted" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function deleted(Announcement $announcement)
    {
        //
    }

    /**
     * Handle the Announcement "restored" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function restored(Announcement $announcement)
    {
        //
    }

    /**
     * Handle the Announcement "force deleted" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function forceDeleted(Announcement $announcement)
    {
        //
    }

    public function generateSlug($value, $next = 0, $action = 'create', $modelId = null)
    {
        $slug = $value;

        if ($action == 'create') {
            while (Announcement::where('slug', $slug)->first()) {
                $slug = $value . '-' . ++$next;
            }
        } else {
            while (Announcement::where('slug', $slug)->where('id', '!=', $modelId)->first()) {
                $slug = $value . '-' . ++$next;
            }
        }

        return $slug;
    }
}
