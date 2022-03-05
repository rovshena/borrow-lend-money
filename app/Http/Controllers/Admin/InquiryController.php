<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $inquiries = Inquiry::all(['id', 'name', 'phone', 'email', 'is_read', 'created_at']);
            return DataTables::of($inquiries)
                ->editColumn('is_read', function ($row) {
                    return '<a href="' . route('admin.inquiries.show', $row) . '"><i class="' . ($row->is_read ? 'far fa-envelope-open' : 'fas fa-envelope') . ' text-warning fa-fw fa-2x"></i></a>';
                })
                ->editColumn('created_at', function ($row) {
                    return optional($row->created_at)->format('d.m.Y H:i:s');
                })
                ->addColumn('icon', function ($row) {
                    return $row->is_read ? '' : '<i class="fas fa-circle text-primary"></i>';
                })
                ->addColumn('actions', function ($row) {
                    $view = '<a href="' . route('admin.inquiries.show', $row) . '" class="btn btn-subtle-primary btn-sm mr-2"><i class="fas fa-eye fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.inquiries.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $view . $delete;
                })
                ->setRowClass(function ($row) {
                    return $row->is_read ? '' : 'font-weight-bold bg-secondary';
                })
                ->rawColumns(['actions', 'is_read', 'icon'])
                ->toJson();
        }

        return view('admin.inquiry.index');
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->update(['is_read' => 1]);
        return view('admin.inquiry.view', ['inquiry' => $inquiry]);
    }

    public function destroy(Inquiry $inquiry)
    {
        if ($inquiry->delete()) {
            return response()->json(['success' => 'The inquiry deleted successfully!']);
        } else {
            return response()->json(['error' => 'Can not delete the inquiry!']);
        }
    }

    public function markAllAsRead()
    {
        Inquiry::unread()->update(['is_read' => 1]);
        return back()->with('success', 'All inquiries marked as read');
    }
}
