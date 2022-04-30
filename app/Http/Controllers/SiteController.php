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
        $policy = Setting::enabled()->where('key', 'privacy_policy')->firstOrFail();
        $heading = optional(Setting::enabled()->where('key', 'privacy_policy_title')->first())->value ?? 'Политика конфиденциальности';
        return view('visitor.site.privacy', compact('policy', 'heading'));
    }

    public function terms()
    {
        $terms = Setting::enabled()->where('key', 'terms_of_use')->firstOrFail();
        $heading = optional(Setting::enabled()->where('key', 'terms_of_use_title')->first())->value ?? 'Условия использования';
        return view('visitor.site.terms', compact('terms', 'heading'));
    }

    public function about()
    {
        $about_us = Setting::enabled()->where('key', 'about_us')->firstOrFail();
        $about_us_excerpt = Setting::enabled()->where('key', 'about_us_excerpt')->first();
        $heading = optional(Setting::enabled()->where('key', 'about_us_title')->first())->value ?? 'О нас';
        return view('visitor.site.about', compact('about_us', 'about_us_excerpt', 'heading'));
    }

    public function showContactUsForm()
    {
        $heading = optional(Setting::enabled()->where('key', 'contact_us_title')->first())->value ?? 'Напишите нам!';
        $contact_us_excerpt = optional(Setting::enabled()->where('key', 'contact_us_excerpt')->first())->value ??
            'Заполните форму, и наша команда постарается связаться с вами в течение 24 часов.';
        return view('visitor.site.contact', compact('heading', 'contact_us_excerpt'));
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
