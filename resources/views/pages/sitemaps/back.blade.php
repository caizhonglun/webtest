@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h1 class="panel-title">網站地圖 <small>Sitemaps</small></h1>
          </div>
          <div class="panel-body">
            <ul class="list-unstyled">
            @foreach ($menu as $arr1)
              @include('pages.sitemaps.partials.li', ['item' => $arr1])
            @endforeach
            </ul>
          </div>
        </div>
    </div>
</div>
@endsection