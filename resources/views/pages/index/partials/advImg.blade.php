<ul class="list-unstyled">
    @foreach($advimg as $item)
        <li>
            <a href="{{ $item->url }}"
            target="_blank"
            title="{{ $item->title }}">
            <img src="{{ asset($item->img_path) }}" alt="{{ $item->title }}" width="240" height="90">
            </a>
        </li>
    @endforeach
</ul>