@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>編輯內容</h1>
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
                <label for="content">內容</label>
                <vue-ckeditor name="content" id="content" value="{{ old('content', $item->content) }}" toolbar="luxury"></vue-ckeditor>
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
