<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('sub-sub-category-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            user()->role == 1 ?
            $subSubCategories = SubSubCategory::with(['category', 'subCategory'])->orderBy('name') :
            $subSubCategories = SubSubCategory::with(['category', 'subCategory'])->whereUser_id(user()->id)->orderBy('name');
            return DataTables::of($subSubCategories)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('sub_category_name', function ($row) {
                    return $row->subCategory->name;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('sub-sub-category-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.sub-sub-category.edit', $row->id) , 'row' => $row]);
                    }
                    if (userCan('sub-sub-category-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.sub-sub-category.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['category_name', 'sub_category_name','action', 'created_at'])
                ->make(true);
        }
        user()->role == 1 ? $categories = Category::orderBy('name')->get(['id','name']) :
        $categories = Category::whereUser_id(user()->id)->orderBy('name')->get(['id','name']);
        return view('dashboard.sub_sub_category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($error = $this->authorize('sub-sub-category-add')) {
            return $error;
        }
        $data = $request->validate([
            'category_id'     => 'required',
            'sub_category_id' => 'required',
            'name'            => 'required|unique:sub_sub_categories,name|string|max:191',
        ]);
        $data['user_id'] = user()->id;

        try {
            SubSubCategory::create($data);
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, SubSubCategory $sub_category)
    {
        if ($error = $this->authorize('category-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $modal = view('dashboard.sub_sub_category.edit')->with(['sub_category' => $sub_category])->render();
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
