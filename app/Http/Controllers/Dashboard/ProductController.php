<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $products= Product::orderBy('id','desc')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.index',compact('products'));
    }
    public function create(){

        $brands=Brand::active()->select('id')->get();
        $tags=Tag::active()->select('id')->get();
        return view('dashboard.products.product_create',compact('brands','tags'));
    }
    public  function store( ProductStoreRequest $request){

       try{
            $requestData=$request->except(['_token','_method','tag','category']);
            $requestData["is_active"]=$request->has("is_active")?1:0;
            $requestData["manage_stock"]=$request->has("manage_stock")?1:0;
            $requestData["in_stock"]=$request->has("in_stock")?1:0;
            DB::beginTransaction();
           $product= Product::create($requestData);
           if(isset($request->category)&&is_array($request->category)){
               $product->categories()->sync($request->category);
           }
           if(isset($request->tag)&&is_array($request->tag)){
               $product->tags()->sync($request->tag);
           }
           DB::commit();
            return redirect()->route('admin.products')->with([
                'success'=>'تم اضافة  المنتج بنجاح'
            ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.products')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }
    public function edit($id)
    {
        $product=Product::find($id);
        $brands=Brand::active()->select('id')->get();
        $tags=Tag::active()->select('id')->get();
        return view('dashboard.products.product_update',compact('product','brands','tags'));
    }
    public  function update($id, ProductRequest $request){
           try{
               $product=Product::find($id);
               if(!$product){
                   return redirect()->route('admin.products')->with(['error'=>'هذا المنتج غير موجود']);
               }else{

                   $requestData=$request->except(['_token','_method','tag','category']);
                   $requestData["is_active"]=$request->has("is_active")?1:0;
                   $requestData["manage_stock"]=$request->has("manage_stock")?1:0;
                   $requestData["in_stock"]=$request->has("in_stock")?1:0;
                   DB::beginTransaction();
                   $product->update($requestData);
                   if(isset($request->category)&&is_array($request->category)){
                       $product->categories()->sync($request->category);
                   }
                   if(isset($request->tag)&&is_array($request->tag)){
                       $product->tags()->sync($request->tag);
                   }else{

                       $product->tags()->detach($product->tags);
                   }
                   DB::commit();
                   return redirect()->route('admin.products')->with([
                       'success'=>'تم تعديل  المنتج بنجاح'
                   ]);


               }
           }

         catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.products')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
         }


    }


    public  function changeStatus($id){
        try{
            $product=Product::find($id);
            if(!$product){
                return redirect()->route('admin.products')->with(['error'=>'هذا المنتج غير موجود']);
            }else{
                $status=$product->is_active===true?0:1;
                $success=$product->is_active===true?'تم الغاء تفعيل المنتج بنجاح':'تم تفعيل المنتج بنجاح';
                $product->update([
                    'is_active'=>$status
                ]);

                return redirect()->route('admin.products')->with([
                    'success'=>$success
                ]);
            }

        }
        catch (\Exception $exception){
            return redirect()->route('admin.products')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }
    }


    public function upload_image($pid){
        if(request()->hasFile('file')){
        //    return \request('file');
            $file_path=uploadImage("products",\request('file'));
          //  return $file_path;
            $add=ProductImage::create([
                'product_id'=>$pid,
                'photo'=>'assets/'.$file_path
            ]);
            return response(['status'=>true,'id'=>$add->id],200);
        }
    }
    public function delete_image(){
        if(request()->has('id')){
            $product=ProductImage::findOrfail(request('id'));
            if(File::exists($product->photo)) {
                File::delete($product->photo);
            }
            $product->delete();
        }
    }

    public  function addImages($id){
        try{
            $product=Product::find($id);
           //return $product->images()->get();
          //  return $product;
            if(!$product){
                return redirect()->route('admin.products')->with(['error'=>'هذا المنتج غير موجود']);
            }else{
                return view('dashboard.products.add_images',compact('product'));
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.products')->with([
                'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
            ]);
        }

    }
}
