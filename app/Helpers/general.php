<?php

define('PAGINATION_COUNT',15);
function getFolder(){
    return app()->getLocale() ==='ar'?'css-rtl':'css';
}

if(!function_exists('load_cat')){
    function load_cat($select=null,$cat_hide=null){
        $categories= \App\Models\Category::get();
     //   dd ($categories->name);
        $cat_arr=[];
        foreach ($categories as $category){
            $list_arr=[];
            $list_arr['icon']='';
            $list_arr['li_attr']='';
            $list_arr['a_attr']='';
            $list_arr['children']=[];
            if($select !== null && $select==$category->id)
            {
                $list_arr['state']=[
                    'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false,

                ];
            }
            if($cat_hide !== null && $cat_hide==$category->id)
            {
                $list_arr['state']=[
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true,
                    'hidden'=>true
                ];
            }
            $list_arr['id']=$category->id;
            $list_arr['parent']=$category->parent_id !== null ?$category->parent_id:'#';
            $list_arr['text']=$category->name;
            array_push($cat_arr,$list_arr);
        }
      //  dd($cat_arr);
        return json_encode($cat_arr,JSON_UNESCAPED_UNICODE);
    }



    if(!function_exists('get_parent')){
        function get_parent($cat_id){
            // $list_department=[];
            $cat=\App\Models\Category::find($cat_id);
            if($cat->parent_id !== null&&$cat->parent_id>0){
                //   array_push($list_department,$department->parent);
                return get_parent($cat->parent_id).','.$cat_id;
            }else{
                return $cat_id;
            }
            // return $list_department;
        }
    }


    function uploadImage($folder,$image){

        $image->store('/',$folder);
        $filename=$image->hashName();
        $path='images/'.$folder.'/'.$filename;
        return $path;
    }





}
