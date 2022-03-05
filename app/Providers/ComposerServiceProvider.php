<?php

namespace App\Providers;

use App\Http\View\Composers\InquiryComposer;
use App\Http\View\Composers\SettingComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.inquiry.dropdown', InquiryComposer::class);
        View::composer(['visitor.*'], SettingComposer::class);
    }
}
