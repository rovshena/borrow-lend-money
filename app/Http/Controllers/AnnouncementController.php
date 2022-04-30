<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowMoneyRequest;
use App\Http\Requests\LendMoneyRequest;
use App\Models\Announcement;
use App\Models\Country;
use App\Models\Setting;

class AnnouncementController extends Controller
{
    public function showBorrowMoneyForm()
    {
        $heading = optional(Setting::enabled()->where('key', 'borrow_money_form_title')->first())->value ?? 'Подать бесплатное объявление (Взять деньги)';
        $countries = Country::enabled()->orderBy('name', 'asc')->get(['id', 'name']);
        return view('visitor.announcement.borrow', compact('countries', 'heading'));
    }

    public function showLendMoneyForm()
    {
        $heading = optional(Setting::enabled()->where('key', 'lend_money_form_title')->first())->value ?? 'Подать бесплатное объявление (Дать займ)';
        $countries = Country::enabled()->orderBy('name', 'asc')->get(['id', 'name']);
        return view('visitor.announcement.lend', compact('countries', 'heading'));
    }

    public function storeBorrowMoney(BorrowMoneyRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = Announcement::TYPE_BORROW;

        Announcement::create($validated);
        return redirect()->route('borrow.money')->with('success', 'Ваше объявление успешно создано.');
    }

    public function storeLendMoney(LendMoneyRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = Announcement::TYPE_LEND;

        Announcement::create($validated);
        return redirect()->route('lend.money')->with('success', 'Ваше объявление успешно создано.');
    }
}
