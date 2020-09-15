@extends('layouts.admin')
@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! load_cat($category->parent_id,$category->id) !!},
                    "themes" : {
                        "variant" : "large"
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow" ]
            });

            $('#jstree').on('changed.jstree',function(e,data){
                var i,j,r=[];
                for (i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(', '));
            });
        });
    </script>
@endpush

@section('content')
    ﻿
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">الأقسام الرئيسية
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل القسم الرئيسى </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.maincategories.update',$category->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="id" value="{{$category->id}}"/>

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img src="" class="rounded-circle height-150" alt="صورة القسم" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="photo" class="file center-block">
                                                    <input type="file" id="photo" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div >
                                                    <h3>الأقسام</h3>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div id="jstree"></div>
                                            <input type="hidden" name="parent_id" class="parent_id" value="{{old('parent')}}"/>
                                            <div class="clearfix"></div>

                                            <div class="form-body">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name_{{$localeCode}}">{{__("_dasboard.".$localeCode.'.name')}} </label>
                                                            <input type="text" value="{{!is_null($category->translate($localeCode))?$category->translate($localeCode)->name:""}}" id="name_{{$localeCode}}"
                                                                   class="form-control"
                                                                   name="{{$localeCode}}[name]">
                                                            @error("{{$localeCode."."}}.name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="slug">الاسم بالرابط</label>
                                                            <input type="text" value="{{$category->slug}}" id="slug"
                                                                   class="form-control"
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="1" name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($category->is_active)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>
                                                            @error("is_active")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop
