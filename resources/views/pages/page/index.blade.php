@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">{{ $item->title }} <small>{{ $item->eng_title }}</small></h1>
    </div>
    <div class="panel-body">{!! $item->content !!}</div>
</div>
@endsection
