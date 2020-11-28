<?php

define('PAGINATION_COUNT',15);
function getFolder(){
    return app()->getLocale() ==='ar'?'css-rtl':'css';
}

if(!function_exists('load_cat')){
    function load_cat($select=null,$cat_hide=null){
        $categories= \App\Models\Category::get();
     //   dd( $categories);
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
            $list_arr['parent']=$category->category_id !== null ?$category->category_id:'#';
            $list_arr['text']=$category->name;
            array_push($cat_arr,$list_arr);
        }
      // dd($cat_arr);
        return json_encode($cat_arr,JSON_UNESCAPED_UNICODE);
    }



    if(!function_exists('get_parent')){
        function get_parent($cat_id){
            // $list_department=[];
            $cat=\App\Models\Category::find($cat_id);
            if($cat->category_id !== null&&$cat->category_id>0){
                //   array_push($list_department,$department->parent);
                return get_parent($cat->category_id).','.$cat_id;
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




if(!function_exists('load_cat_product')){
    function load_cat_product($select=null,$cat_hide=null){
      //  dd($cat_hide);
        $categories= \App\Models\Category::get();
        //   dd( $categories);
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
            if($cat_hide !== null && in_array($category->id,$cat_hide) )
            {
                $list_arr['state']=[
                    'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false,
                    'hidden'=>false
                ];
            }
            $list_arr['id']=$category->id;
            $list_arr['parent']=$category->category_id !== null ?$category->category_id:'#';
            $list_arr['text']=$category->name;
            array_push($cat_arr,$list_arr);
        }
        // dd($cat_arr);
        return json_encode($cat_arr,JSON_UNESCAPED_UNICODE);
    }



    if(!function_exists('get_parent')){
        function get_parent($cat_id){
            // $list_department=[];
            $cat=\App\Models\Category::find($cat_id);
            if($cat->parent_id !== null&&$cat->category_id>0){
                //   array_push($list_department,$department->parent);
                return get_parent($cat->category_id).','.$cat_id;
            }else{
                return $cat_id;
            }
            // return $list_department;
        }
    }

    if(!function_exists('uploadImage')) {
        function uploadImage($folder, $image)
        {

            $image->store('/', $folder);
            $filename = $image->hashName();
            $path = 'images/' . $folder . '/' . $filename;
            return $path;
        }
    }





}
