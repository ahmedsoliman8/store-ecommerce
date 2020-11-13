<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Http\Requests\TagStore;
use App\Http\Requests\TagUpdate;
use App\Models\Tag;

use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index(){
        $tags= Tag::orderBy('id','desc')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index',compact('tags'));
    }
    public function create(){
        return view('dashboard.tags.create');
    }
    public  function store(TagStore $request){

        try{
            $requestData=$request->except(['_token','_method']);

            $requestData["is_active"]=$request->has("is_active")?1:0;
            DB::beginTransaction();
            Tag::create($requestData);
            DB::commit();
            return redirect()->route('admin.tags')->with([
                'success'=>'تم اضافة  العلامة بنجاح'
            ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.tags')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function edit($id){

        $tag=Tag::find($id);

        $tag->makeVisible(['translations']);
        if(!$tag){
            return redirect()->route('admin.tags',$tag->id)->with([
                'error'=>'هذا العلامة غير موجود'
            ]);
        }

        return view('dashboard.tags.edit',compact('tag'));
    }
    public  function update($id, TagUpdate $request){

        try{
            $tag=Tag::find($id);
            if(!$tag){
                return redirect()->route('admin.tags')->with(['error'=>'هذا العلامة غير موجود']);
            }else{
                $requestData=$request->except(['_token','_method']);
                $requestData["is_active"]=$request->has("is_active")?1:0;
                DB::beginTransaction();
                $tag->update($requestData);
                DB::commit();
                return redirect()->route('admin.tags')->with([
                    'success'=>'تم تحديث  العلامة بنجاح'
                ]);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.tags')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }

    public  function destroy($id){
        try{
            $tag=Tag::find($id);
            if(!$tag){
                return redirect()->route('admin.tags',$tag->id)->with([
                    'error'=>'هذا العلامة غير موجود'
                ]);
            }
            $tag->deleteTranslations();
            $tag->delete();
            return redirect()->route('admin.tags')->with([
                'success'=>'تم حذف  العلامة بنجاح'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.tags')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }


    public  function changeStatus($id){
        try{
            $tag=Tag::find($id);
            if(!$tag){
                return redirect()->route('admin.tags')->with(['error'=>'هذا العلامة غير موجود']);
            }else{
                $status=$tag->is_active===true?0:1;
                $success=$tag->is_active===true?'تم الغاء تفعيل العلامة بنجاح':'تم تفعيل العلامة بنجاح';
                $tag->update([
                    'is_active'=>$status
                ]);

                return redirect()->route('admin.tags')->with([
                    'success'=>$success
                ]);
            }

        }
        catch (\Exception $exception){
            return redirect()->route('admin.tags')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }




}
