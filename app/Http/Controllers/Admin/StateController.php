<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $states = State::all(['id', 'name', 'iso_code', 'country_id']);
            return DataTables::of($states)
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.states.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.states.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $edit . $delete;
                })
                ->editColumn('country_id', function ($row) {
                    return $row->country->name ?? '';
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.state.index');
    }

    public function create()
    {
        return view('admin.state.create', [
            'countries' => Country::orderBy('name')->pluck('name', 'id')
        ]);
    }

    public function store(StateRequest $request)
    {
        State::create($request->validated());
        return redirect()->route('admin.states.index')->with('success', __('Новый регион успешно добавлен.'));
    }

    public function edit(State $state)
    {
        return view('admin.state.edit', [
            'countries' => Country::orderBy('name')->pluck('name', 'id'),
            'state' => $state
        ]);
    }

    public function update(StateRequest $request, State $state)
    {
        if ($state->update($request->validated())) {
            return redirect()->route('admin.states.index')->with('success', __('Регион успешно обновлен.'));
        } else {
            return back()->with('error', __('Не могу обновить регион.'));
        }
    }

    public function destroy(Request $request, State $state)
    {
        if ($request->ajax()) {
            if ($state->delete()) {
                return response()->json(['success' => __('Регион успешно удален.')]);
            } else {
                return response()->json(['error' => __('Не могу удалить регион.')]);
            }
        } else {
            return response()->json(['error' => __('Запрещено')]);
        }
    }
}
