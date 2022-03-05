<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view)
    {
        $variables = Setting::enabled()
            ->whereIn('key', ['title', 'description', 'keyword', 'author', 'address', 'phone', 'fax', 'email'])
            ->get(['key', 'value']);

        $settings = [];

        foreach ($variables as $variable) {
            $settings[$variable->key] = $variable->value;
        }

        $view->with('shared_settings', $settings);
    }
}
