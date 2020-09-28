<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products= Product::orderBy('id','desc')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.index',compact('products'));
    }
    public function create(){
       /* $data = [
            'ar' => ['name' => '','description'=>''],
            'en' => ['name' => '','description'=>''],
        ];
        $product=  Product::create($data);
        if(!empty($product)){
            return redirect()->route('admin.products.edit',$product->id);
        }*/
        $brands=Brand::active()->select('id')->get();
        $tags=Tag::active()->select('id')->get();
        return view('dashboard.products.product_create',compact('brands','tags'));
    }
    public  function store( ProductStoreRequest $request){
        return $request->all();
    }
    public function edit($id)
    {
        $product=Product::find($id);
        $brands=Brand::active()->select('id')->get();
        $tags=Tag::active()->select('id')->get();
        return view('dashboard.products.product_update',compact('product','brands','tags'));

    }
    public  function update($id, ProductRequest $request){
        return $request->all();
    }
}
