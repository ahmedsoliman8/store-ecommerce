<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryStore;
use App\Http\Requests\MainCategoryUpdate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    public function index(){
        $categories= Category::orderBy('id','desc')->paginate(PAGINATION_COUNT);
       return view('dashboard.categories.index',compact('categories'));
    }
    public function create(){
        return view('dashboard.categories.create');
    }
    public  function store(MainCategoryStore $request){

        try{
            $requestData=$request->except(['_token','_method']);
            $requestData["is_active"]=$request->has("is_active")?1:0;
            DB::beginTransaction();
            Category::create($requestData);
            DB::commit();
            return redirect()->route('admin.maincategories')->with([
                    'success'=>'تم اضافة  القسم بنجاح'
                ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.maincategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function edit($id){

        $category=Category::find($id);

       $category->makeVisible(['translations']);
        if(!$category){
            return redirect()->route('admin.maincategories',$category->id)->with([
                'error'=>'هذا القسم غير موجود'
            ]);
        }

        return view('dashboard.categories.edit',compact('category'));
    }
    public  function update($id, MainCategoryUpdate $request){

        try{
            $category=Category::find($id);
            if(!$category){
                return redirect()->route('admin.maincategories')->with(['error'=>'هذا القسم غير موجود']);
            }else{
                $requestData=$request->except(['_token','_method']);
                $requestData["is_active"]=$request->has("is_active")?1:0;
                DB::beginTransaction();
                $category->update($requestData);
                DB::commit();
                return redirect()->route('admin.maincategories')->with([
                    'success'=>'تم تحديث  القسم بنجاح'
                ]);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.maincategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }
    public static  function deleteParent($id){
        $cat_parent=Category::where('parent_id',$id)->get();
      //  dd($cat_parent);
        foreach ($cat_parent as $sub){
            self::deleteParent($sub->id);
            $subCat=  Category::find($sub->id);
            if(!empty($subCat)){
                $subCat->deleteTranslations();
                $subCat->delete();           }
        }
        $category= Category::find($id);
        $category->deleteTranslations();
        $category->delete();
    }
    public  function destroy($id){
        try{
            $category=Category::find($id);
            if(!$category){
                return redirect()->route('admin.maincategories',$category->id)->with([
                    'error'=>'هذا القسم غير موجود'
                ]);
            }
            self::deleteParent($id);
           // return $category;
            return redirect()->route('admin.maincategories')->with([
                'success'=>'تم حذف  القسم بنجاح'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.maincategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }


    public  function changeStatus($id){
        try{
            $category=Category::find($id);
            if(!$category){
                return redirect()->route('admin.maincategories')->with(['error'=>'هذا القسم غير موجود']);
            }else{
                $status=$category->is_active===true?0:1;
                $success=$category->is_active===true?'تم الغاء تفعيل القسم بنجاح':'تم تفعيل القسم بنجاح';
                $category->update([
                    'is_active'=>$status
                ]);

                return redirect()->route('admin.maincategories')->with([
                    'success'=>$success
                ]);
            }

        }
        catch (\Exception $exception){
            return redirect()->route('admin.maincategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }




}
