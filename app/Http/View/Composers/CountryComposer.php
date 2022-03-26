<?php

namespace App\Http\View\Composers;

use App\Models\Country;
use Illuminate\View\View;

class CountryComposer
{
    public function compose(View $view)
    {
        $countries = Country::enabled()->get(['id', 'name', 'slug']);
        $view->with('countries', $countries);
    }
}
