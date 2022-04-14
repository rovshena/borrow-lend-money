<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view)
    {
        $variables = Setting::enabled()
            ->whereIn('key', [
                'title',
                'description',
                'keyword',
                'author',
                'address',
                'phone',
                'fax',
                'email',
                'vk_link',
                'telegram_link',
                'messenger_link',
                'privacy_policy',
                'terms_of_use',
                'about_us',
                'credit_calculator',
            ])
            ->pluck('value', 'key');

        $view->with('shared_settings', $variables);
    }
}
