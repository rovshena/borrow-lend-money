<?php

namespace App\Http\Controllers;

class CaptchaController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
