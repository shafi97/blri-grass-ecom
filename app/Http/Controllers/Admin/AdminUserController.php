<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('admin-user-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            $admin_users = User::whereIn('role',['1']);
            return DataTables::of($admin_users)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_'.$row->id.'" class="check" value="'.$row->id.'">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('age', function ($row) {
                    return ageWithDays($row->d_o_b);
                })
                ->addColumn('image', function ($row) {
                    $src = asset('uploads/images/users/'.$row->image);
                    return '<img src="'.$src.'" width="100px">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('admin-user-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.admin-user.edit', $row->id) , 'row' => $row]);
                    }
                    if (userCan('admin-user-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.admin-user.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['check', 'age', 'action', 'image', 'created_at'])
                ->make(true);
        }
        $roles = Role::all();
        return view('dashboard.admin_user.index', compact('roles'));
    }


    public function store(AdminUserStoreRequest $request)
    {
        if ($error = $this->authorize('admin-user-add')) {
            return $error;
        }
        $data = $request->validated();
        $data['role'] = '1';
        if($request->hasFile('image')){
            $data['image'] = imageStore($request, 'image','user', 'uploads/images/users/');
        }

        try {
            $admin_user = User::create($data);
            $admin_user->assignRole($request->role);
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, User $admin_user)
    {
        if ($error = $this->authorize('admin-user-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $roles = Role::all();
            $modal = view('dashboard.admin_user.edit')->with(['admin_user' => $admin_user, 'roles' => $roles])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function update(AdminUserUpdateRequest $request, User $admin_user)
    {
        if ($error = $this->authorize('admin-user-add')) {
            return $error;
        }
        $data = $request->validated();
        if(user()->email != $request->email){
            $data['email'] = $request->email;
        }
        if(isset($request->password)){
            $data['password'] = bcrypt($request->password);
        }
        $image = user()->image;
        if($request->hasFile('image')){
            $data['image'] = imageUpdate($request, 'image', 'user', 'uploads/images/user/', $image);
        }
        try {
            $admin_user->update($data);
            $admin_user->assignRole($request->role);
            // if($request->permission){
            //     $permission = [
            //         'role_id' =>  $request->permission,
            //         'model_type' => "App\Models\User",
            //         'model_id' =>  $admin_user->id,
            //     ];
            //     ModelHasRole::whereModel_id($admin_user->id)->update($permission);
            // }
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(User $admin_user)
    {
        if ($error = $this->authorize('admin-user-delete')) {
            return $error;
        }
        try {
            $admin_user->delete();
            return response()->json(['message'=> __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=> __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
