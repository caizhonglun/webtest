@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-header">
            <h1>{{ $theme }}</h1>
        </div>
        <district-back :years="{{ json_encode($years) }}"></district-back>
    </div>
</div>
@endsection
