<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $locale
     * @return RedirectResponse
     */
    public function __invoke($locale)
    {
        if (Arr::exists(config('app.available_locales', ['en' => 'English']), $locale)) {
            App::setLocale($locale);
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
