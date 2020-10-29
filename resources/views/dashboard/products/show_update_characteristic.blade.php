{{--
    <div class="col-md-12">
        <label>{{$option->attribute->name}}</label>
        <label> {{$option->name}} </label>
        <label>     <a  href="{{route("admin.products.edit.characteristic",$option->id)}}"    class="edit_characteristic btn btn-warning"><i class="fa fa-edit"></i> </a></label>
        <label>   <a  href="{{route("admin.products.remove.characteristic",$option->id)}}"    class="remove_characteristic btn btn-danger"><i class="fa fa-trash"></i> </a></label>
    </div>
    <div class="clearfix"></div>
    <br/>
--}}


        <td>{{$option->attribute->name}} </td>
        <td> {{$option->name}} </td>
        <td>
            <a  href="{{route("admin.products.edit.characteristic",$option->id)}}"    class="edit_characteristic btn btn-warning"><i class="fa fa-edit"></i> </a>
            <a  href="{{route("admin.products.remove.characteristic",$option->id)}}"    class="remove_characteristic btn btn-danger"><i class="fa fa-trash"></i> </a>
        </td>

