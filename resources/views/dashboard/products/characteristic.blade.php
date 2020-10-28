@extends('layouts.admin')
@push('script')
       <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click','.remove_characteristic',function (e) {
                e.preventDefault();
                var  url=$(this).attr("href");
                $.ajax({
                    url:url,
                    type:'GET',
                    dataType:'json',
                    beforeSend:function () {
                    },
                    success: function (data) {
                        if(data.status ==true){
                            $('#characteristic_'+data.id).remove();
                        }else{
                           alert(data.result);
                        }
                    },
                    error:function (data_error,exception) {

                    }

                });
              return false;
            });

            $(document).on('click','.add_characteristic',function (e) {
                    e.preventDefault();
                    var form=$('.characteristicSubmit')[0];
                    var token = "{{csrf_token()}}";
                    var fdata= new FormData(form);
                    fdata['_token'] = token;
                    var url=$('.characteristicSubmit').attr('action');
                    $.ajax({
                        url:url,
                        type:'post',
                        dataType:'json',
                        data:fdata,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        beforeSend:function () {
                            $('.alert_error ul').empty();
                        },
                        success: function (data) {
                            if(data.status ==true){
                                $('.div_characteristics').append(data.result);

                            }else{
                                  var error_list='';
                            //    $.each(data_error.responseJSON.errors,function (index,v) {
                                    error_list += '<li>'+data.result+'</li>';
                             //   });
                                 $('.alert_error ul').append(error_list);
                            }
                        },
                        error:function (data_error,exception) {
                            if(exception == 'error'){
                                var error_list='';
                                $.each(data_error.responseJSON.errors,function (index,v) {
                                    error_list += '<li>'+v+'</li>';
                                });
                                $('.alert_error ul').append(error_list);
                            }
                        }

                    });
                    return false;
                });

        });

    </script>
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <center><h3>خصائص المنتج</h3></center>
                                        <div  class="div_characteristics col-lg-12 col-md-12 col-sm-12">
                                            @foreach($product->options as $option)
                                                <div class="row characteristic" id="characteristic_{{$option->id}}">
                                                    <div class="col-md-12">
                                                        <label>{{$option->attribute->name}}</label>
                                                        <label> {{$option->name}} </label> <label>
                                                            <a data-option_id="{{$option->id}}" href="{{route("admin.products.remove.characteristic",$option->id)}}"    class="remove_characteristic btn btn-danger"><i class="fa fa-trash"></i> </a></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br/>

                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="clearfix"></div>
                                        <br/>

                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                        <div class="clearfix"></div>
                                        <br/>


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">اضافة خاصية جديدة</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  action="{{route('admin.products.add.characteristic')}}"  method="POST" class="characteristicSubmit">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                                            <div class="alert_error">
                                                                <center><h1></h1></center>
                                                                <ul>

                                                                </ul>
                                                            </div>
                                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name_{{$localeCode}}">{{__("_dasboard.".$localeCode.'.name')}} </label>
                                                                        <input type="text"  required value="{{ old($localeCode . '.name') }}" id="name_{{$localeCode}}"
                                                                               class="form-control"
                                                                               name="{{$localeCode}}[name]" >
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
                                                                        <label for="attribute_id">  اختار الخاصية</label>
                                                                        <select name="attribute_id" required  class="select2  form-control">
                                                                            <optgroup label="من فضلك أختر الخاصية ">
                                                                                @if(isset($attributes) && $attributes -> count() > 0)
                                                                                    @foreach($attributes as $attribute)
                                                                                        <option
                                                                                            {{ old('attribute_id') == $attribute -> id ? "selected":"" }}
                                                                                            value="{{$attribute -> id }}">{{$attribute -> name}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </optgroup>
                                                                        </select>
                                                                        @error("attribute_id")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                        <button type="button" class="btn btn-primary add_characteristic">حفظ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>﻿

@stop





