<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryStore;
use App\Http\Requests\MainCategoryUpdate;
use App\Http\Requests\SubCategoryStore;
use App\Http\Requests\SubCategoryUpdate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriesController extends Controller
{
    public function index(){
        $categories= Category::child()->orderBy('id','desc')->paginate(PAGINATION_COUNT);
       return view('dashboard.subcategories.index',compact('categories'));
    }
    public function create(){
        $categories= Category::parent()->get();
        return view('dashboard.subcategories.create',compact('categories'));
    }
    public  function store(SubCategoryStore $request){
        try{
            $requestData=$request->except(['_token','_method']);
            $requestData["is_active"]=$request->has("is_active")?1:0;
            DB::beginTransaction();
            Category::create($requestData);
            DB::commit();
            return redirect()->route('admin.subcategories')->with([
                    'success'=>'تم اضافة  القسم بنجاح'
                ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.subcategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function edit($id){
        $category=Category::find($id);
       $category->makeVisible(['translations']);
        $categories= Category::parent()->get();
        if(!$category){
            return redirect()->route('admin.subcategories',$category->id)->with([
                'error'=>'هذا القسم غير موجود'
            ]);
        }

        return view('dashboard.subcategories.edit',compact('category','categories'));
    }
    public  function update($id, SubCategoryUpdate $request){
    // return $request->all();
        try{
            $category=Category::find($id);
            if(!$category){
                return redirect()->route('admin.subcategories')->with(['error'=>'هذا القسم غير موجود']);
            }else{
                $requestData=$request->except(['_token','_method']);
                $requestData["is_active"]=$request->has("is_active")?1:0;

                DB::beginTransaction();
                $category->update($requestData);

                DB::commit();
                return redirect()->route('admin.subcategories')->with([
                    'success'=>'تم تحديث  القسم بنجاح'
                ]);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.subcategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function destroy($id){
        try{
            $category=Category::find($id);
            if(!$category){
                return redirect()->route('admin.subcategories',$category->id)->with([
                    'error'=>'هذا القسم غير موجود'
                ]);
            }
            $category->deleteTranslations();
            $category->delete();
            return redirect()->route('admin.subcategories')->with([
                'success'=>'تم حذف  القسم بنجاح'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.subcategories')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }

}
