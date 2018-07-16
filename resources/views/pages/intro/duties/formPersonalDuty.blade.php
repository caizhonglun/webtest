@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="page-header">
            <h1>人員職掌 <small>Personal Duty</small></h1>
        </div>
        <form class="form-horizontal" action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">
            @isset($update)
                {{ method_field('PATCH') }}
            @endisset
            {{ csrf_field() }}

            @include('partials.intro.resume')

            <div class="form-group">
                <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary btn-block">確認送出</button>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="{{ route('personalduty.back', session('nowDutyID')) }}" class="btn btn-default btn-block">取消</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
