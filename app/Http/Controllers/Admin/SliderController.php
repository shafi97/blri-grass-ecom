<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('slider-manage')) {
            return $error;
        }
        if ($request->ajax()) {
                user()->role == 1 ? $sliders = Slider::query() :
                $sliders = Slider::whereUser_id(user()->id);
            return DataTables::of($sliders)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('image', function ($row) {
                    $src = imagePath('slider', $row->image);
                    return '<img src="'.$src.'" width="200px">';
                })
                ->addColumn('text', function ($row) {
                    return html_entity_decode($row->text);
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('slider-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.slider.edit', $row->id) , 'row' => $row]);
                    }
                    if (userCan('slider-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.slider.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['text','image', 'action', 'created_at'])
                ->make(true);
        }
        return view('dashboard.slider.index');
    }

    public function store(Request $request)
    {
        if ($error = $this->authorize('slider-add')) {
            return $error;
        }
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,JPG,png|max:3072',
            'text'  => 'required',
        ]);
        $data['user_id'] = user()->id;
        if($request->hasFile('image')){
            $data['image'] = imageStore($request, 'image','slider', 'uploads/images/slider/');
        }

        try {
            Slider::create($data);
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, Slider $slider)
    {
        if ($error = $this->authorize('slider-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $modal = view('dashboard.slider.edit')->with(['slider' => $slider])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }
    public function update(Request $request, Slider $slider)
    {
        if ($error = $this->authorize('slider-add')) {
            return $error;
        }
        $data = $request->validate([
            'name' =>'required|string|max:191',
        ]);
        try {
            $slider->update($data);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(Category $category)
    {
        if ($error = $this->authorize('slider-delete')) {
            return $error;
        }
        try {
            $slider->delete();
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=> __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
