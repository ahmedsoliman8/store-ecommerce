@extends('layouts.admin')
@push('script')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/dropzone/css/dropzone.min.css')}}">
    <script type="text/javascript" src="{{asset('assets/admin/plugins/dropzone/js/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover=false;
        $(document).ready(function () {
            $('#dropzonefileupload').dropzone({
                url:"{{route('admin.upload.image',$product->id)}}",
               // autoProcessQueue: false,
                paramName:'file',
                uploadMultiple:false,
                maxFiles:15,
                maxFilesize:2,
                acceptedFiles:'image/*',
                dictDefaultMessage:'قم بسحب الملفات وافلتها هنا',
                dictRemoveFile:'حذف',
                params:{
                    _token:"{{csrf_token()}}"
                },
                addRemoveLinks:true,

                removedfile:function(file){
                    $.ajax({
                        dataType:'json',
                        type:'post',
                        url:'{{ route("admin.delete.image") }}',
                        data:{_token:'{{csrf_token()}}',id:file.fid}

                    });
                    var fmock;
                    return (fmock=file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
                },
                init:function () {
                        @foreach($product->images()->get() as $image)
                    var mock={

                            fid: '{{$image->id}}'
                        };
                    this.emit('addedfile',mock);
                    this.options.thumbnail.call(this,mock,'{{url($image->photo)}}');
                    @endforeach
                        this.on('sending',function (file,xhr,formData) {
                        formData.append('fid','');
                        file.fid='';
                    });
                    this.on('success',function (file,response) {
                        file.fid=response.id;
                    });
                }
            });


        });

    </script>
    <style type="text/css">
        .dz-image img{
            width: 200px;
            height: 200px;
        }
    </style>
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
                                        <center><h3>صور المنتج</h3></center>
                                        <div class="dropzone" id="dropzonefileupload"></div>

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





