

    <li class="item   {{$childern -> categories->count()>0?"parent":""}}">
        <a href="{{route('category',$childern -> slug )}}"
           title="{{$childern -> name}}">{{$childern -> name}}</a>
        @isset($childern -> categories )
            <span class="show-sub fa-active-sub"></span>
            <div class="dropdown-menu" style="width:222px">
                <ul>
                    @foreach($childern -> categories  as $_childern)

                      @include('site.includes.child_category',['childern'=>$_childern])
                    @endforeach
                </ul>
            </div>
        @endisset
    </li>
