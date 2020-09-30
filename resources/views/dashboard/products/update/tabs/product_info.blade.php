<div id="product_info" class="tab-pane fade in active">

    <div class="form-body">
        <div class="row">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_{{$localeCode}}">{{__("_dasboard.".$localeCode.'.name')}} </label>
                        <input type="text" value="{{!is_null($product->translate($localeCode))?$product->translate($localeCode)->name:""}}" id="name_{{$localeCode}}"
                               class="form-control"
                               name="{{$localeCode}}[name]">
                        @error("{{$localeCode."."}}.name")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
        @endforeach
    </div>
            <div class="row">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_{{$localeCode}}">{{__("_dasboard.".$localeCode.'.description')}} </label>
                            <textarea   id="description_{{$localeCode}}"
                                   class="form-control"
                                   name="{{$localeCode}}[description]">
                                {{!is_null($product->translate($localeCode))?$product->translate($localeCode)->description:""}}
                            </textarea>
                            @error("{{$localeCode."."}}.description")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
            @endforeach
            </div>
            <div class="row">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="short_description_{{$localeCode}}">{{__("_dasboard.".$localeCode.'.short_description')}} </label>
                            <textarea   id="short_description_{{$localeCode}}"
                                       class="form-control"
                                       name="{{$localeCode}}[short_description]">
                                {{!is_null($product->translate($localeCode))?$product->translate($localeCode)->short_description:""}}
                            </textarea>
                            @error("{{$localeCode."."}}.short_description")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
            @endforeach
            </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="brand_id">  اختار البرند</label>
                    <select name="brand_id"  class="select2  form-control">
                        <optgroup label="من فضلك أختر البرند ">
                            @if(isset($brands) && $brands -> count() > 0)
                                @foreach($brands as $brand)
                                    <option
                                        {{ $product->brand_id == $brand -> id ? "selected":"" }}
                                        value="{{$brand -> id }}">{{$brand -> name}}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    </select>
                    @error("brand_id")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tag">  اختار العلامات الدلالية</label>

                    <select name="tag[]" multiple  class="select2  form-control">
                        <optgroup label="من فضلك أختر العلامات ">
                            @if(isset($tags) && $tags -> count() > 0)
                                @foreach($tags as $tag)
                                    <option
                                        {{
                                         in_array($tag->id,$product->tags->pluck('id')->toArray()) ?'selected':'' }}
                                        value="{{$tag -> id }}">{{$tag -> name}}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    </select>
                    @error("tag")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">الاسم بالرابط</label>
                    <input type="text" value="{{$product->slug}}" id="slug"
                           class="form-control"
                           name="slug">
                    @error("slug")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-1">
                    <input type="checkbox"  value="1" name="is_active"
                           id="switcheryColor4"
                           class="switchery" data-color="success"
                           @if($product->is_active) checked @endif
                    />
                    <label for="switcheryColor4"
                           class="card-title ml-1">الحالة </label>
                    @error("is_active")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>




    </div>



</div>
