<tr id="characteristic_{{$option->id}}">

    <td>{{$option->attribute->name}} </td>
    <td> {{$option->name}} </td>
    <td>{{$option->price}}</td>
    <td>
        <a  href="{{route("admin.products.edit.characteristic",$option->id)}}"    class="edit_characteristic btn btn-warning"><i class="fa fa-edit"></i> </a>
        <a  href="{{route("admin.products.remove.characteristic",$option->id)}}"    class="remove_characteristic btn btn-danger"><i class="fa fa-trash"></i> </a>
    </td>
</tr>
