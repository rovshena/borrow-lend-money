<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    const COUNTRY_DATASET = 'database/countries.json';

    protected $guarded = ['id'];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
