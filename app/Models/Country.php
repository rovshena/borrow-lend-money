<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    const CIS_COUNTRIES = [
        'AZ', 'AM', 'BY', 'GE', 'KZ', 'KG', 'MD', 'RU', 'TJ', 'TM', 'UZ', 'UA'
    ];

    protected $guarded = ['id'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
