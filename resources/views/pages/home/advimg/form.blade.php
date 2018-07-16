@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $update ? '修改活動看板' : '新增活動看板' }}</h1>
</div>
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

        <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">
            @if($update)
                {{ method_field('PATCH') }}
            @endif
            {{ csrf_field() }}
            <div class="form-group">
                <label for="thumbnail">圖片(240X90)<span class="text-danger">*</span></label>
                <vue-image-preview
                    image-src="{{ $item->img_path ? asset($item->img_path) : ''}}"
                    :style="{width: '200px'}"></vue-image-preview>
            </div>
            <div class="form-group">
                <label for="title">標題<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title" placeholder="必填" value="{{ old('title', $item->title) }}" required>
            </div>
            <div class="form-group">
                <label for="url">網址連結<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="url" id="url" placeholder="必填" value="{{ old('url', $item->url) }}" required>
            </div>
            <div class="form-group">
                <label for="organizer">申請單位<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="organizer" id="organizer" placeholder="必填" maxlength="40" value="{{ old('organizer', $item->organizer) }}" required>
            </div>
            <div class="form-group">
                <label for="phone">聯絡電話<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="必填" maxlength="40" value="{{ old('phone', $item->phone) }}" required>
            </div>
            <div class="form-group">
                <label for="maintainedBy">網站維護</label>
                <input type="text" class="form-control" name="maintainedBy" id="maintainedBy" maxlength="40" value="{{ old('maintainedBy', $item->maintained_by) }}">
            </div>
            <hr>
            <div class="form-group text-right">
                <a href="{{ route('advimg.back') }}" class="btn btn-default btn-lg">返回</a>
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
        </form>
    </div>
</div>
@endsection