@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="page-header">
        <h1>{{ $unit->name2 }}<small>{{ $unit->engName }}</small></h1>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="list-group">
            @if($personalDuty->img_path)
            <li class="list-group-item">
                <h4>大頭貼</h4>
                <blockquote><img src="{{ asset($personalDuty->img_path) }}" alt="大頭貼"></blockquote>
            </li>
            @endif
            <li class="list-group-item">
                <h4>姓名</h4>
                <blockquote>{{ $personalDuty->name }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>科室</h4>
                <blockquote>{{ $unit->name2 }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>職位</h4>
                <blockquote>{{ $personalDuty->position }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>電話</h4>
                <blockquote>{{ $personalDuty->telephone }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>分機</h4>
                <blockquote>{{ $personalDuty->telephone_extension }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>專線</h4>
                <blockquote>{{ $personalDuty->direct_telephone }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>傳真</h4>
                <blockquote>{{ $personalDuty->fax }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>連絡信箱</h4>
                <blockquote>{{ $personalDuty->email }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>代理人</h4>
                <blockquote>{{ $personalDuty->agent }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>業務內容</h4>
                <blockquote class="ql-editor">{!! $personalDuty->duty !!}</blockquote>
            </li>
            <li class="list-group-item text-center">
                <a href="{{ route('personalduty.back', session('nowDutyID')) }}" class="btn btn-primary btn-lg">確認無誤</a>
                <a href="{{ route('personalduty.edit', $personalDuty->id) }}" class="btn btn-primary btn-lg">繼續修改</a>
            </li>
        </ul>
    </div>
</div>
@endsection
