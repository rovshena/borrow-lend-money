<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\Inquiry;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function privacy()
    {
        $policy = Setting::where('key', 'privacy_policy')->firstOrFail();
        return view('visitor.site.privacy', compact('policy'));
    }

    public function terms()
    {
        $terms = Setting::where('key', 'terms_of_use')->firstOrFail();
        return view('visitor.site.terms', compact('terms'));
    }

    public function about()
    {
        $settings = Setting::whereIn('key', ['about_us', 'about_us_excerpt'])->get();
        return view('visitor.site.about', compact('settings'));
    }

    public function contact(InquiryRequest $request)
    {
        $inquiry = Inquiry::create([
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'phone' => $request->contact_phone,
            'content' => $request->contact_content
        ]);

        try {
            Mail::send(new ContactFormSubmitted($inquiry));
        } catch (\Exception $exception) {
            Log::channel('mailer')->error('Mail could not be sent. Mailer Error: ' . $exception->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Ваше сообщение было успешно отправлено. Спасибо, что связались с нами!');
    }
}
