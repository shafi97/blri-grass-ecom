<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('partner-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            user()->role == 1 ? $partners = Partner::orderBy('name') :
                $partners = Partner::whereUser_id(user()->id)->orderBy('name');
            return DataTables::of($partners)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_' . $row->id . '" class="check" value="' . $row->id . '">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('image', function ($row) {
                    $src = asset('uploads/images/partner/' . $row->image);
                    return '<img src="' . $src . '" height="80px">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('partner-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.partner.edit', $row->id), 'row' => $row]);
                    }
                    if (userCan('partner-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.partner.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['check', 'image', 'action', 'created_at'])
                ->make(true);
        }
        return view('dashboard.partner.index');
    }

    public function store(Request $request)
    {
        if ($error = $this->authorize('partner-add')) {
            return $error;
        }
        $data = $request->validate([
            'name'  => 'nullable|max:191',
            'image' => 'required|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG',
        ]);
        $data['user_id'] = user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = imageStore($request, 'image', 'partner', 'uploads/images/partner');
        }
        try {
            Partner::create($data);
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, Partner $partner)
    {
        if ($error = $this->authorize('partner-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $modal = view('dashboard.partner.edit')->with(['partner' => $partner])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }
    public function update(Request $request, Partner $partner)
    {
        if ($error = $this->authorize('partner-add')) {
            return $error;
        }
        $data = $request->validate([
            'name'  => 'required|string|max:191',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = imageUpdate($request, 'image', 'partner', 'uploads/images/partner/', $partner->image);
        }
        try {
            $partner->update($data);
            return response()->json(['message' => 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(Partner $partner)
    {
        if ($error = $this->authorize('partner-delete')) {
            return $error;
        }
        $checkPath =  public_path('uploads/images/partner/' . $partner->image);
        if (file_exists($checkPath)) {
            unlink($checkPath);
        }
        try {
            $partner->delete();
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
