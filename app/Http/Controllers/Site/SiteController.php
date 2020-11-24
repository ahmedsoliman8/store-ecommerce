<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public  function index(){

        $sliders=Slider::all();

        return view('site.index',compact('sliders'));

    }
}
