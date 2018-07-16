@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-header">
            <h1>{{ $item->title }} <small>{{ $item->eng_title }}</small></h1>
        </div>
        <page-content id="{{ $item->id }}" value="{{ $item->content }}"></page-content>
    </div>
</div>
@endsection