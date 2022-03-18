<?php

namespace App\Models;

use App\Traits\HasStatusAttribute;
use App\Traits\HasStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, HasStatusAttribute, HasStatusScope;

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
