@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="page-header">
      <h1>{{ session('nowDutyName') }} - 人員職掌</h1>
    </div>

    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"></div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <a href="{{ route('personalduty.create') }}"
           class="btn btn-info btn-lg btn-block"
        >新增</a>
    </div>

    @include('pages.intro.duties..partial.personalDutiesList')
</div>
@endsection
