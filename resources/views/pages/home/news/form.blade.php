@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $update ? $item->title . ' - 修改' : '新增最新消息' }}</h1>
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
                <label for="announceStart">公告起始日<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="announceStart" id="announceStart" placeholder="必填，格式：dd/mm/yyyy" value="{{ old('announceStart', $item->announce_start) }}" required>
            </div>
            <div class="form-group">
                <label for="announceEnd">公告迄止日<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="announceEnd" id="announceEnd" placeholder="必填，格式：dd/mm/yyyy" value="{{ old('announceEnd', $item->announce_end) }}" required>
            </div>
            <div class="form-group">
                <label for="sort">類別</label>
                <select name="sort" id="sort" class="form-control" required="required">
                    <option disabled value="">請選擇</option>
                    <option value="公告"
                        {{ $item->sort == '公告' ? 'selected' : '' }}
                    >公告</option>
                    <option value="轉知"
                        {{ $item->sort == '轉知' ? 'selected' : '' }}
                    >轉知</option>
                    <option value="維修"
                        {{ $item->sort == '維修' ? 'selected' : '' }}
                    >維修</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">標題<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title" placeholder="必填" value="{{ old('title', $item->title) }}" required>
            </div>
            <div class="form-group">
                <label for="content">內容</label>
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
            <div class="form-group">
                <label for="attachs">檔案附件</label>
                @isset($attachs)
                <ul class="list-unstyled">
                    @foreach($attachs as $attach)
                    <li>
                        <button type="button" class="close"
                                style="float: left"
                                @click="deleteItem('{{ route('news.attach.delete', $attach->id) }}')"
                        >&times;</button>
                        &nbsp;
                        <a href="{{ asset($attach->path) }}"
                           download="{{ $attach->name }}" 
                        >{{ $attach->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endisset
                <input type="file" name="attachs[]" id="attachs" accept="application/pdf,application/zip" multiple>
                <p class="help-block">
                    <ol>
                        <li>若檔案數較多，請一次選取多個檔案。</li>
                        <li>目前僅開放pdf檔及zip檔上傳。</li>
                        <li>本公告屬公開訊息，凡附件檔案屬機密性、或涉及個人資料，請勿於此提供公開下載。</li>
                        <li>為響應自由軟體的推行，上傳檔案請提供多個版本供使用者下載。</li>
                    </ol>
                </p>
            </div>
            <hr>
            <div class="form-group text-right">
                <a href="{{ route('news.back') }}" class="btn btn-default btn-lg">返回</a>
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
        </form>
    </div>
</div>
@endsection
