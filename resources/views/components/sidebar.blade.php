<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($items as $item)
        <li class="nav-item">
<<<<<<< HEAD
            <a href="{{route($item['route'])}}" class="nav-link {{ Route::is($item['active']) ? 'active' : '' }}">
=======
            <a href="{{route($item['route'])}}" class="nav-link {{ Route::is($item['route']) ? 'active' : '' }}">
>>>>>>> 8e030c27665d3d02b4aaf7f3228cebe265f68afe
                <i class="{{$item['icon']}}"></i>
                <p style="color:white">
                   {{$item['title']}}
                   @isset($item['badge'])
                   <span class="right badge badge-danger">{{$item['badge']}}</span>
                   @endisset
                </p>
            </a>
        </li>
        @endforeach
<<<<<<< HEAD

    </ul>
</nav>
=======
       
    </ul>
</nav>
>>>>>>> 8e030c27665d3d02b4aaf7f3228cebe265f68afe
