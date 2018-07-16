@isset ($item['next'])
    @include('partials.dropdownMenu', ['menu' => $item])
@elseif (isset($item['route']))
<li>
    <a href="{{ route($item['route'], $item['param']) }}"
    >{{ $item['title'] }}</a>
</li>
@elseif (isset($item['url']))
<li>
    <a href="{{ $item['url'] }}" target="_blank"
        title="承辦單位：{{ $item['organizer'] }} {{ $item['contact_phone'] }}"
    >{{ $item['title'] }}</a>
</li>
@endisset
