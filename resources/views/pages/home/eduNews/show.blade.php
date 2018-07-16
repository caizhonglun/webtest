@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">教育新聞</h3>
            </div>
            <div class="panel-body">
                <h1>{{ $item->title }}</h1>
                <p>
                    活動日期：{{ $item->activity_start }}～{{ $item->activity_end }}<br>
                    承辦單位：{{ $item->organizer }}&nbsp;
                    承辦人：{{ $item->contractor }}&nbsp;
                    聯絡電話：{{ $item->contact_phone }}
                    <hr>
                    <div class="ql-editor">{!! $item->content !!}</div>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection