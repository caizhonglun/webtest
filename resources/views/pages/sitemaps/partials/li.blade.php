@isset($item['next'])
    <li>{{ $item['title'] }}</li>
    <ul>
        @foreach ($item['next'] as $next)
            @include('pages.sitemaps.partials.li', ['item' => $next])
        @endforeach
    </ul>
@elseif(isset($item['route']))
    <li>
        <a href="{{ route($item['route'], $item['param']) }}"
        >{{ $item['title'] }}</a>
    </li>
@elseif(isset($item['url']))
    <li><a href="{{ $item['url'] }}">{{ $item['title'] }}(外部連結)</a></li>
@else
    <li>{{ $item['title'] }}</li>
@endisset
