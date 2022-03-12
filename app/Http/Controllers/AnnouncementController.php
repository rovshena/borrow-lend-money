<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowMoneyRequest;
use App\Http\Requests\LendMoneyRequest;
use App\Models\Announcement;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function showBorrowMoneyForm()
    {
        $countries = Country::orderBy('name', 'asc')->get(['id', 'name']);
        return view('visitor.announcement.borrow', compact('countries'));
    }

    public function showLendMoneyForm()
    {
        $countries = Country::orderBy('name', 'asc')->get(['id', 'name']);
        return view('visitor.announcement.lend', compact('countries'));
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
