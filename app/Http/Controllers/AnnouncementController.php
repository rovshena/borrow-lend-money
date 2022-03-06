<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowMoneyRequest;
use App\Models\Announcement;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function showBorrowMoneyForm()
    {
        $countries = Country::orderBy('name', 'asc')->get(['id', 'name']);
        return view('visitor.announcement.borrow', compact('countries'));
    }

    public function getStates(Country $country)
    {
        return $country->states()->orderBy('name')->get(['id', 'name']);
    }

    public function storeBorrowMoney(BorrowMoneyRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = Announcement::TYPE_BORROW;
        if (Auth::check()) {
            $validated['user_id'] = Auth::guard('account')->id();
        }

        Announcement::create($validated);
        return redirect()->route('borrow.money')->with('success', __('Your announcement created successfully.'));
    }
}
