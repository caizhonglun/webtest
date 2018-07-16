@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="panel-title">政策宣導</h1>
            </div>

            <ul class="list-group">
                @foreach ($items as $item)
                <li class="list-group-item"><a href="{{ route('policy.show', $item->id) }}">{{ $item->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection