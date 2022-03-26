<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Country::all(['id', 'name', 'slug', 'iso3', 'iso2', 'status']);
            return DataTables::of($countries)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.countries.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.countries.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $edit . $delete;
                })
                ->editColumn('status', function ($row) {
                    return $row->status_badge;
                })
                ->rawColumns(['actions', 'status'])
                ->toJson();
        }

        return view('admin.country.index');
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(CountryRequest $request)
    {
        Country::create($request->validated());
        return redirect()->route('admin.countries.index')->with('success', __('Новая страна успешно добавлена.'));
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(CountryRequest $request, Country $country)
    {
        if ($country->update($request->validated())) {
            return redirect()->route('admin.countries.index')->with('success', __('Страна успешно обновлена.'));
        } else {
            return back()->with('error', __('Не могу обновить страну.'));
        }
    }

    public function destroy(Request $request, Country $country)
    {
        if ($request->ajax()) {
            if ($country->delete()) {
                return response()->json(['success' => __('Страна успешно удалена.')]);
            } else {
                return response()->json(['error' => __('Не могу удалить страну.')]);
            }
        } else {
            return response()->json(['error' => __('Запрещено')]);
        }
    }

    public function cities(Country $country)
    {
        return $country->cities()->enabled()->orderBy('name')->get(['id', 'name']);
    }
}
