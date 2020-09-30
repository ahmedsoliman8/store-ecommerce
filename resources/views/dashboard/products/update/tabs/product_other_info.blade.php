<div id="product_other_info" class="tab-pane fade in active">

    <div class="form-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">السعر</label>
                    <input type="number" value="{{$product->price}}" id="price" min="1" step="0.0001"
                           class="form-control"
                           name="price">
                    @error("price")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selling_price">سعر الشراء</label>
                    <input type="number" value="{{$product->selling_price}}" id="selling_price" min="1"  step="0.0001"
                           class="form-control"
                           name="selling_price">
                    @error("selling_price")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="special_price">السعر المخصص</label>
                    <input type="number" value="{{$product->special_price}}" id="special_price" min="1" step="0.0001"
                           class="form-control"
                           name="special_price">
                    @error("special_price")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="special_price_type"> نوع السعر المخصص</label>
                    <input type="text" value="{{$product->special_price_type}}" id="special_price_type"
                           class="form-control"
                           name="special_price_type">
                    @error("special_price_type")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="special_price_start"> تاريخ بداية السعر المخصص</label>
                    <input type="text" value="{{$product->special_price_start}}" id="special_price_start"
                           class="form-control datepicker" autocomplete="off"
                           name="special_price_start">
                    @error("special_price_start")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="special_price_end">  تاريخ نهاية السعر المخصص</label>
                    <input type="text" value="{{$product->special_price_end}}" id="special_price_end"
                           class="form-control datepicker" autocomplete="off"
                           name="special_price_end">
                    @error("special_price_end")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sku">sku</label>
                    <input type="text" value="{{$product->sku}}" id="sku"
                           class="form-control"
                           name="sku">
                    @error("sku")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="qty">الكمية</label>
                    <input type="number" value="{{$product->qty}}" id="qty" min="1"
                           class="form-control"
                           name="qty">
                    @error("qty")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mt-1">
                    <input type="checkbox"  value="1" name="manage_stock"
                           id="switcheryColor4"
                           class="switchery" data-color="success"
                           @if($product->manage_stock) checked @endif
                    />
                    <label for="switcheryColor4"
                           class="card-title ml-1">manage_stock </label>
                    @error("manage_stock")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mt-1">
                    <input type="checkbox"  value="1" name="in_stock"
                           id="switcheryColor4"
                           class="switchery" data-color="success"
                           @if($product->in_stock) checked @endif
                    />
                    <label for="switcheryColor4"
                           class="card-title ml-1">in_stock </label>
                    @error("in_stock")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>





    </div>



</div>
