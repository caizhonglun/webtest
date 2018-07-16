@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">{{ $theme }}</h1>
    </div>
    <div class="panel-body">
        <district-index :years="{{ json_encode($years) }}"></district-index>
    </div>
</div>
@endsection
