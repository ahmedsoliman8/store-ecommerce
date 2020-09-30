<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
       // return $request->all();
       try{
            $requestData=$request->except(['_token','_method','tag','category']);
            $requestData["is_active"]=$request->has("is_active")?1:0;
            $requestData["manage_stock"]=$request->has("manage_stock")?1:0;
            $requestData["in_stock"]=$request->has("in_stock")?1:0;
            DB::beginTransaction();
           $product= Product::create($requestData);
           if(isset($request->category)&&is_array($request->category)){
               $product->categories()->attach($request->category);
           }
           if(isset($request->category)&&is_array($request->tag)){
               $product->tags()->attach($request->tag);
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
       // return $product;
        $brands=Brand::active()->select('id')->get();
        $tags=Tag::active()->select('id')->get();
        return view('dashboard.products.product_update',compact('product','brands','tags'));

    }
    public  function update($id, ProductRequest $request){
        return $request->all();
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
}
