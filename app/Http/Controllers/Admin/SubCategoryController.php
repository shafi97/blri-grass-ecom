<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('sub-category-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            user()->role == 1 ?
            $sub_category = SubCategory::with('category')->orderBy('name') :
            $sub_category = SubCategory::with('category')->whereUser_id(user()->id)->orderBy('name');
            return DataTables::of($sub_category)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('sub-category-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.category.edit', $row->id) , 'row' => $row]);
                    }
                    if (userCan('sub-category-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.category.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['category_name','action', 'created_at'])
                ->make(true);
        }
        user()->role == 1 ? $categories = Category::orderBy('name')->get(['id','name']) :
        $categories = Category::whereUser_id(user()->id)->orderBy('name')->get(['id','name']);
        return view('dashboard.sub_category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($error = $this->authorize('sub-category-add')) {
            return $error;
        }
        $data = $request->validate([
            'category_id' =>'required',
            'name' =>'required|unique:sub_categories,name|string|max:191',
        ]);
        $data['user_id'] = user()->id;

        try {
            SubCategory::create($data);
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, SubCategory $sub_category)
    {
        if ($error = $this->authorize('category-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $modal = view('dashboard.sub_category.edit')->with(['sub_category' => $sub_category])->render();
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
            'name' =>'required|string|max:191',
        ]);
        try {
            $category->update($data);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(Category $category)
    {
        if ($error = $this->authorize('category-delete')) {
            return $error;
        }
        try {
            $category->delete();
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=> __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
