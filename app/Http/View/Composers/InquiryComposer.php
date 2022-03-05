<?php

namespace App\Http\View\Composers;

use App\Models\Inquiry;
use Illuminate\View\View;

class InquiryComposer
{
    public function compose(View $view)
    {
        $inquiries = Inquiry::unread()->orderByDesc('id')->get(['id', 'name', 'phone', 'created_at']);
        $view->with('inquiries', $inquiries);
    }
}
