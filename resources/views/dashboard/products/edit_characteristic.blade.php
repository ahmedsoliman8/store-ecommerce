<form class="form" action="{{route('admin.products.update.characteristic',$option->id)}}"
      method="POST"
      >
    @csrf
    @method('POST')
    <input type="hidden" name="id" value="{{$option->id}}"/>
    <input type="hidden" name="product_id" value="{{$option->product_id}}"/>

    <div class="form-body">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name_{{$localeCode}}">{{__("_dasboard.".$localeCode.'.name')}} </label>
                        <input type="text" value="{{!is_null($option->translate($localeCode))?$option->translate($localeCode)->name:""}}" id="name_{{$localeCode}}"
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
                        <label for="attribute_id">  اختار الخاصية</label>
                        <select name="attribute_id"  class="select2  form-control">
                            <optgroup label="من فضلك أختر الخاصية ">
                                @if(isset($attributes) && $attributes -> count() > 0)
                                    @foreach($attributes as $attribute)
                                        <option
                                            {{ $attribute->id == $option ->attribute_id ? "selected":"" }}
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


    </div>


</form>
