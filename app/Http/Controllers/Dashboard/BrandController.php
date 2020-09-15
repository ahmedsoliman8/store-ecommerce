<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStore;
use App\Http\Requests\BrandUpdate;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{

    public function index(){
        $brands= Brand::orderBy('id','desc')->paginate(PAGINATION_COUNT);
       // return $brands;
        return view('dashboard.brands.index',compact('brands'));
    }
    public function create(){
        return view('dashboard.brands.create');
    }
    public  function store(BrandStore $request){

       // return $request->all();
        try{
            $requestData=$request->except(['_token','_method']);
            //dd( $requestData);
            $requestData["is_active"]=$request->has("is_active")?1:0;
            if($request->has('photo')){
                $file_path=uploadImage("brands",$request->photo);
                $requestData['photo']=$file_path;
            }
            DB::beginTransaction();
            Brand::create($requestData);
            DB::commit();
            return redirect()->route('admin.brands')->with([
                'success'=>'تم اضافة  البرند بنجاح'
            ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.brands')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function edit($id){
        //delete_parent($id);
        $brand=Brand::find($id);
        // return $brand;
        $brand->makeVisible(['translations']);
        if(!$brand){
            return redirect()->route('admin.brands',$brand->id)->with([
                'error'=>'هذا البرند غير موجود'
            ]);
        }
        //return $brand;
        return view('dashboard.brands.edit',compact('brand'));
    }
    public  function update($id, BrandUpdate $request){
        try{
            $brand=Brand::find($id);
            if(!$brand){
                return redirect()->route('admin.brands')->with(['error'=>'هذا البرند غير موجود']);
            }else{
                $requestData=$request->except(['_token','_method']);
                $requestData["is_active"]=$request->has("is_active")?1:0;
                if($request->has('photo')){
                    $file_path=uploadImage("brands",$request->photo);
                    if(File::exists('assets/'.$brand->photo)) {
                        File::delete('assets/'.$brand->photo);
                    }
                    $requestData['photo']=$file_path;
                }
               // return $requestData;
                DB::beginTransaction();
                $brand->update($requestData);
                DB::commit();
                return redirect()->route('admin.brands')->with([
                    'success'=>'تم تحديث  البرند بنجاح'
                ]);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.brands')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function destroy($id){
        try{
            $brand=Brand::find($id);
            if(!$brand){
                return redirect()->route('admin.brands',$brand->id)->with([
                    'error'=>'هذا البرند غير موجود'
                ]);
            }
            if(File::exists('assets/'.$brand->photo)) {
                File::delete('assets/'.$brand->photo);
            }
            $brand->deleteTranslations();
            $brand->delete();
            // return $brand;
            return redirect()->route('admin.brands')->with([
                'success'=>'تم حذف  البرند بنجاح'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.brands')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }


    public  function changeStatus($id){
        try{
            $brand=Brand::find($id);
            if(!$brand){
                return redirect()->route('admin.brands')->with(['error'=>'هذا البرند غير موجود']);
            }else{
                $status=$brand->is_active===true?0:1;
                $success=$brand->is_active===true?'تم الغاء تفعيل البرند بنجاح':'تم تفعيل البرند بنجاح';
                $brand->update([
                    'is_active'=>$status
                ]);

                return redirect()->route('admin.brands')->with([
                    'success'=>$success
                ]);
            }

        }
        catch (\Exception $exception){
            return redirect()->route('admin.brands')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }
}
