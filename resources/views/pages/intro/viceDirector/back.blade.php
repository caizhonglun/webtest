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
            <h1>副局長介紹<small>Vice Director-general</small></h1>
        </div>
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#vice0" aria-controls="vice0" role="tab" data-toggle="tab">副局長1</a>
                </li>
                <li role="presentation">
                    <a href="#vice1" aria-controls="vice1" role="tab" data-toggle="tab">副局長2</a>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content">
                @foreach ($viceDirectors as $item)
                <div role="tabpanel"
                     class="tab-pane {{ $loop->first ? 'active' : '' }}"
                     id="vice{{ $loop->index }}">
                     <form class="form-horizontal"
                           action="{{ route('vicedirector.update', $item->id) }}"
                           method="POST" role="form" enctype="multipart/form-data">
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection