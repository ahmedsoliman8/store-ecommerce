<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function upload_slider(){
      //  return \request('file');
        if(request()->hasFile('file')){

            $file_path=uploadImage("sliders",\request('file'));

            $add=Slider::create([

                'photo'=>'assets/'.$file_path
            ]);
            return response(['status'=>true,'id'=>$add->id],200);
        }
    }
    public function delete_slider(){
        if(request()->has('id')){
            $slider=Slider::findOrfail(request('id'));
            if(File::exists($slider->photo)) {
                File::delete($slider->photo);
            }
            $slider->delete();
        }
    }

    public  function addSliders(){
            $sliders=Slider::all();
            return view('dashboard.sliders.add_images',compact('sliders'));
    }
}
