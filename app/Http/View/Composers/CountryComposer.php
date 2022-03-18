<?php

namespace App\Http\View\Composers;

use App\Models\Country;
use Illuminate\View\View;

class CountryComposer
{
    public function compose(View $view)
    {
        $countries = Country::all(['id', 'name']);
        $view->with('countries', $countries);
    }
}
