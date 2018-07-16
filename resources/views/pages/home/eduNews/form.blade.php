@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $update ? $item->title . ' - 修改' : '新增教育新聞' }}</h1>
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
                <label for="activityStart">活動起始日<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="activityStart" id="activityStart" placeholder="必填，格式：dd/mm/yyyy" value="{{ old('activityStart', $item->activity_start) }}" required>
            </div>
            <div class="form-group">
                <label for="activityEnd">活動迄止日<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="activityEnd" id="activityEnd" placeholder="必填，格式：dd/mm/yyyy" value="{{ old('activityEnd', $item->activity_end) }}" required>
            </div>
            <div class="form-group">
                <label for="themeImg">標題圖片<span class="text-danger">*</span></label>
                <vue-image-preview
                    image-src="{{ asset($item->theme_img_path) }}"
                    name="themeImg"
                    id="themeImg"></vue-image-preview>
            </div>
            <div class="form-group">
                <label for="title">標題<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title" placeholder="必填" value="{{ old('title', $item->title) }}" maxlength="80" required>
            </div>
            <div class="form-group">
                <label for="content">內容<span class="text-danger">*</span></label>
                <vue-ckeditor name="content" id="content" value="{{ old('content', $item->content) }}" toolbar="luxury"></vue-ckeditor>
            </div>
            <div class="form-group">
                <label for="organizer">承辦單位<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="organizer" id="organizer" placeholder="必填" maxlength="40" value="{{ old('organizer', $item->organizer) }}" required>
            </div>
            <div class="form-group">
                <label for="contractor">承辦人<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contractor" id="contractor" placeholder="必填" maxlength="40" value="{{ old('contractor', $item->contractor) }}" required>
            </div>
            <div class="form-group">
                <label for="contactPhone">聯絡電話<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contactPhone" id="contactPhone" placeholder="必填" maxlength="40" value="{{ old('contactPhone', $item->contact_phone) }}" required>
            </div>
            <hr>
            <div class="form-group text-right">
                <a href="{{ route('edunews.back') }}" class="btn btn-default btn-lg">返回</a>
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
        </form>
    </div>
</div>
@endsection
