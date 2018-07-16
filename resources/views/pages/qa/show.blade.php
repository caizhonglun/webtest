@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $item->title }}</h3>
            </div>
            <div class="panel-body">
                {!! $item->content !!}
            </div>
        </div>
    </div>
</div>
@endsection