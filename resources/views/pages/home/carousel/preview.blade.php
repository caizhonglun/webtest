@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $item->title }} - 幻燈片</h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="list-group">
            <li class="list-group-item">
                <img src="{{ asset($item->img_path) }}" class="img-responsive" alt="Image">
            </li>
            <li class="list-group-item">
                <h4>標題</h4>
                <blockquote>{{ $item->title }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>網址連結</h4>
                <blockquote>{{ $item->url }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>承辦單位</h4>
                <blockquote>{{ $item->organizer }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>聯絡電話</h4>
                <blockquote>{{ $item->phone }}</blockquote>
            </li>
            <li class="list-group-item text-center">
                <a href="{{ route('carousel.edit', $item->id) }}" class="btn btn-primary btn-lg">繼續修改</a>
                <a href="{{ route('carousel.back') }}" class="btn btn-default btn-lg">確認</a>
            </li>
        </ul>
    </div>
</div>
@endsection