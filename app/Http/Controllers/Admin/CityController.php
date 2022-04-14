<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cities = City::all(['id', 'name', 'status', 'oblast', 'region', 'country_id']);
            return DataTables::of($cities)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.cities.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.cities.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $edit . $delete;
                })
                ->editColumn('status', function ($row) {
                    return $row->status_badge;
                })
                ->editColumn('country_id', function ($row) {
                    return $row->country->name ?? '';
                })
                ->rawColumns(['actions', 'status'])
                ->toJson();
        }

        return view('admin.city.index');
    }

    public function create()
    {
        return view('admin.city.create', [
            'countries' => Country::orderBy('name')->pluck('name', 'id')
        ]);
    }

    public function store(CityRequest $request)
    {
        City::create($request->validated());
        return redirect()->back()->with('success', __('Новый город успешно добавлен.'));
    }

    public function edit(City $city)
    {
        return view('admin.city.edit', [
            'countries' => Country::orderBy('name')->pluck('name', 'id'),
            'city' => $city
        ]);
    }

    public function update(CityRequest $request, City $city)
    {
        if ($city->update($request->validated())) {
            return redirect()->back()->with('success', __('Город успешно обновлен.'));
        } else {
            return back()->with('error', __('Не могу обновить город.'));
        }
    }

    public function destroy(Request $request, City $city)
    {
        if ($request->ajax()) {
            if ($city->delete()) {
                return response()->json(['success' => __('Город успешно удален.')]);
            } else {
                return response()->json(['error' => __('Не могу удалить город.')]);
            }
        } else {
            return response()->json(['error' => __('Запрещено')]);
        }
    }
}
