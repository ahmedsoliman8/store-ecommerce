<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function editProfile(){
       $admin=Admin::find( auth('admin')->user()->id);
       return view('dashboard.profile.edit',compact('admin'));
    }
    public function updateProfile(ProfileRequest $request){
        try{
            $requestData=$request->only(['name','password','email']);
            $admin=Admin::find( auth('admin')->user()->id);
            if(!empty($request->password)&&!is_null($request->password)){
                $requestData['password']=bcrypt($request->password);
            }else{
                unset($requestData['password']);
            }
            DB::beginTransaction();
            $admin->update($requestData);
            DB::commit();
            return redirect()->back()->with([
                'success'=>'تم تحديث  البيانات بنجاح'
            ]);
        }
        catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }
}
