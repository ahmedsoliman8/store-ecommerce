<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\attributestore;
use App\Http\Requests\AttributeUpdate;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
class AttributeController extends Controller
{

    public function index(){
        $attributes= Attribute::orderBy('id','desc')->paginate(PAGINATION_COUNT);
        // return $attributes;
        return view('dashboard.attributes.index',compact('attributes'));
    }
    public function create(){
        return view('dashboard.attributes.create');
    }
    public  function store(AttributeStore $request){
        // return $request->all();
        try{
            $requestData=$request->except(['_token','_method']);
            DB::beginTransaction();
            Attribute::create($requestData);
            DB::commit();
            return redirect()->route('admin.attributes')->with([
                'success'=>'تم اضافة  الخاصية بنجاح'
            ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.attributes')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function edit($id){
        //delete_parent($id);
        $attribute=Attribute::find($id);
        // return $brand;
        $attribute->makeVisible(['translations']);
        if(!$attribute){
            return redirect()->route('admin.attributes',$attribute->id)->with([
                'error'=>'هذا الخاصية غير موجود'
            ]);
        }
        //return $brand;
        return view('dashboard.attributes.edit',compact('attribute'));
    }
    public  function update($id, AttributeUpdate $request){
        try{
            $attribute=Attribute::find($id);
            if(!$attribute){
                return redirect()->route('admin.attributes')->with(['error'=>'هذا الخاصية غير موجود']);
            }else{
                $requestData=$request->except(['_token','_method']);
                DB::beginTransaction();
                $attribute->update($requestData);
                DB::commit();
                return redirect()->route('admin.attributes')->with([
                    'success'=>'تم تحديث  الخاصية بنجاح'
                ]);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.attributes')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function destroy($id){
        try{
            $attribute=Attribute::find($id);
            if(!$attribute){
                return redirect()->route('admin.attributes',$attribute->id)->with([
                    'error'=>'هذا الخاصية غير موجود'
                ]);
            }

            $attribute->deleteTranslations();
            $attribute->delete();
            // return $brand;
            return redirect()->route('admin.attributes')->with([
                'success'=>'تم حذف  الخاصية بنجاح'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.attributes')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }


}
