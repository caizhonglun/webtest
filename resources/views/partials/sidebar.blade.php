<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $sidebar['title'] }}</h3>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
        @foreach ($sidebar['next'] as $item)
            @isset($item['next'])
            <li>{{ $item['title'] }}
                <ul>
                @foreach($item['next'] as $subItem)
                    @include('partials.li', ['item' => $subItem])
                @endforeach
                </ul>
            </li>
            @else
                @include('partials.li', ['item' => $item])
            @endisset
        @endforeach
        </ul>
    </div>
</div>
