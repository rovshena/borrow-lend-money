<?php

namespace App\Traits;

trait HasStatusAttribute
{
    public function getStatusBadgeAttribute()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-success">Enabled</span>';
        } else {
            return '<span class="badge badge-danger">Disabled</span>';
        }
    }
}
