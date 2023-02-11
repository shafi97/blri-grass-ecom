<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function registerView()
    {
        $districts = District::orderBy('name')->get();
        return view('auth.front_register', compact('districts'));
    }

    public function getUpazila(Request $request)
    {
        $datum = Upazila::whereDistrict_id($request->district_id)->get();
        $upazilas = view('frontend.layout.includes.upazila', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $upazilas, 'upazilas']);
    }

    public function getUnion(Request $request)
    {
        $datum = Union::whereUpazilla_id($request->upazila_id)->get();
        $unions = view('frontend.layout.includes.union', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $unions, 'unions']);
    }

    // public function getUpazila(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $upazilas = Upazila::whereDistrict_id($request->district_id)->get();
    //         return response()->json(['upazilas'=>$upazilas,'status'=>200]);
    //     }
    // }

    public function store(UserStoreRequest $userStoreRequest)
    {
        $data = $userStoreRequest->validated();
        $data['role'] = '3';
        // if($userStoreRequest->hasFile('image')){
        //     $data['image'] = imageStore($userStoreRequest, 'image','user', 'uploads/images/users/');
        // }
        try{
            User::create($data);
            Alert::success('Success','Registration Success');
            return back();
        }catch(\Exception $e){}
            Alert::error('Opps..','Registration Failed');
            return redirect()->route('frontend.login');
    }

    public function login()
    {
        return view('auth.front_login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('index');
    }
}
