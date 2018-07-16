@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @include('pages.intro.viceDirector.partial')
    </div>
    <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
        <a href="{{ route('vicedirector.back') }}" class="btn btn-primary btn-block">確認</a>
    </div>
</div>
@endsection
