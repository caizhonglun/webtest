@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">最新消息公告</h3>
            </div>
            <div class="panel-body">
                <h1>{{ $item->title }}</h1>
                <p>
                    公告日期：{{ $item->announce_start }}～{{ $item->announce_end }}<br>
                    承辦單位：{{ $item->organizer }}<br>
                    承辦人：{{ $item->contractor }}<br>
                    聯絡電話：{{ $item->contact_phone }}<br>
                    公告內容：<br>
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
                </p>
            </div>
        </div>
    </div>
</div>
@endsection