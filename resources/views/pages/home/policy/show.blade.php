@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $item->title }}</h3>
            </div>
            <div class="panel-body">
                <div class="ql-editor">{!! $item->content !!}</div>
                @if(count($attachs))
                檔案附件：<br>
                <ul>
                    @foreach($attachs as $attach)
                    <li>
                        <a href="{{ asset($attach->path) }}"
                           target="_blank" 
                           download="{{ $attach->name }}" 
                        >{{ $attach->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection