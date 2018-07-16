<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-submenu>{{ $menu['title'] }} <b class="caret"></b></a>
    <ul class="dropdown-menu">
        @foreach ($menu['next'] as $item)
            @if (isset($item['next']))
            <li class="dropdown-submenu">
                <a href="#">{{ $item['title'] }}</a>
                <ul class="dropdown-menu">
                    @foreach ($item['next'] as $subitem)
                        @include('partials.li', ['item' => $subitem])
                    @endforeach
                </ul>
            </li>
            @else
                @include('partials.li', ['item' => $item])
            @endif
        @endforeach
    </ul>
</li>