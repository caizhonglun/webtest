@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $item->title }}</h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="list-group">
            <li class="list-group-item">
                <h4>標題</h4>
                <blockquote>{{ $item->title }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>內容</h4>
                <blockquote class="ql-editor">{!! $item->content !!}</blockquote>
            </li>
            @if(count($attachs) > 0)
            <li class="list-group-item">
                <h4>檔案附件</h4>
                <ul>
                    @foreach($attachs as $attach)
                    <li>
                        <a href="{{ asset($attach->path) }}"
                           download="{{ $attach->name }}" 
                        >{{ $attach->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endif
            <li class="list-group-item text-center">
                <a href="{{ route('policy.edit', $item->id) }}" class="btn btn-primary btn-lg">繼續修改</a>
                <a href="{{ route('policy.back') }}" class="btn btn-default btn-lg">確認</a>
            </li>
        </ul>
    </div>
</div>
@endsection