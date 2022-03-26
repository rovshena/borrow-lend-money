<?php

namespace App\Models;

use App\Traits\HasStatusAttribute;
use App\Traits\HasStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, HasStatusAttribute, HasStatusScope;

    const CIS_COUNTRIES = [
        'AZ', 'AM', 'BY', 'GE', 'KZ', 'KG', 'MD', 'RU', 'TJ', 'TM', 'UZ', 'UA'
    ];

    const COUNTRY_DATASET = 'database/countries.json';

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
