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
            <h1>主任秘書介紹<small>Chief Secretary</small></h1>
        </div>
        <form class="form-horizontal" action="{{ route('chiefsecretary.update', $item->id) }}" method="POST" role="form" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @include('partials.intro.sirResume')

            <div class="form-group">
                <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <button type="submit" class="btn btn-primary btn-block">確認送出</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
