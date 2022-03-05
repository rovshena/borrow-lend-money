<?php

namespace App\Traits;

trait HasStatusScope
{
    public function scopeEnabled($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDisabled($query)
    {
        return $query->where('status', 0);
    }
}
