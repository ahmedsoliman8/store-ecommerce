@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var category=document.getElementById("category");
            category.style.visibility = 'hidden';
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! load_cat_product(null,null) !!},
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
                category.type="hidden";
                for (x=0;x<r.length;x++){
                    console.log(r[x]);
                  var option = document.createElement("option");
                    option.text =r[x];
                    option.value=r[x];
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
    <select type="hidden" name="category[]" id="category" class="category_id" >
    </select>
</div>
