<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public  function index(){

        $sliders=Slider::all();
        $categories = Category::Active()->whereNull('category_id')
            ->with('childrenCategories')
            ->get();
      //return $categories->first();
        return view('site.index',compact('sliders','categories'));

    }
    public  function category(){
        $categories = Category::active()->whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        return view('site.includes.child', compact('categories'));
    }
}
