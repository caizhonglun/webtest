<marquee behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()">
    @foreach($marquee as $item)
        <a href="{{ $item->url }}" target="_blank"
           title="{{ $item->title }}；承辦單位：{{ $item->organizer }},{{ $item->phone }}"
        >
            <img src="{{ asset($item->img_path) }}" alt="{{ $item->title }}">
        </a>
    @endforeach
</marquee>