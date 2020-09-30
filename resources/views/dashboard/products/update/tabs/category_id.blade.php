@push('script')
    <script type="text/javascript">
        $(document).ready(function () {

            var category=document.getElementById("category");
          //  category.style.visibility = 'hidden';
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! load_cat_product(null,$product->categories->pluck('id')->toArray()) !!},
                    "themes" : {
                        "variant" : "large"
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "checkbox" ]
            });


            $('#jstree').on('changed.jstree',function(e,data){
                var x, i,j,r=[];
                for (i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);

                }
                category.innerHTML="";
                for (x=0;x<r.length;x++){
                    var option = document.createElement("option");
                    option.text =parseInt(r[x]);
                    option.selected=true;
                    option.value=parseInt(r[x]);
                    category.add(option);
                }
                category.style.visibility = 'hidden';
            });
        });
    </script>
@endpush
<div id="category_id" class="tab-pane fade in active">
    <h3>الاقسام</h3>
    <div id="jstree"></div>
    <select  name="category[]" multiple id="category" class="category_id" >
    </select>
</div>
