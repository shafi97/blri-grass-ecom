<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('category-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            user()->role == 1 ? $category = Category::orderBy('name') :
                $category = Category::whereUser_id(user()->id)->orderBy('name');
            return DataTables::of($category)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_' . $row->id . '" class="check" value="' . $row->id . '">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('image', function ($row) {
                    $src = asset('uploads/images/category/' . $row->image);
                    return '<img src="' . $src . '" height="80px">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('category-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.category.edit', $row->id), 'row' => $row]);
                    }
                    if (userCan('category-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.category.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['check', 'image', 'action', 'created_at'])
                ->make(true);
        }
        return view('dashboard.category.index');
    }

    public function store(Request $request)
    {
        if ($error = $this->authorize('category-add')) {
            return $error;
        }
        $data = $request->validate([
            'name'  => 'required|unique:categories,name|string|max:191',
            'image' => 'required|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG',
        ]);
        $data['user_id'] = user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = imageStore($request, 'image', 'category', 'uploads/images/category');
        }
        try {
            Category::create($data);

            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, Category $category)
    {
        if ($error = $this->authorize('category-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $modal = view('dashboard.category.edit')->with(['category' => $category])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }
    public function update(Request $request, Category $category)
    {
        if ($error = $this->authorize('category-add')) {
            return $error;
        }
        $data = $request->validate([
            'name'  => 'required|string|max:191',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = imageUpdate($request, 'image', 'category', 'uploads/images/category/', $category->image);
        }
        try {
            $category->update($data);
            return response()->json(['message' => 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(Category $category)
    {
        if ($error = $this->authorize('category-delete')) {
            return $error;
        }
        $checkPath =  public_path('uploads/images/category/' . $category->image);
        if (file_exists($checkPath)) {
            unlink($checkPath);
        }
        try {
            $category->delete();
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
