<div id="carousel-example-generic"
     class="carousel slide"
     data-ride="carousel"
     data-interval="3500">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @foreach($carousel as $item)
      <div class="item {{ $loop->first ? 'active' : '' }}">
        <a href="{{ $item->url }}" target="_blank">
          <img src="{{ asset($item->img_path) }}" class="img-responsive" alt="{{ $item->title }}">
        </a>
      </div>
    @endforeach
  </div>
</div>