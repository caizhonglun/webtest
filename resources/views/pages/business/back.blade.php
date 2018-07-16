@extends('layouts.backend')

@section('content')
<div class="container-filud" id="tabs">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Announcement" aria-controls="Announcement" role="tab" data-toggle="tab">{{ $item->name1 }}</a></li>
            <li role="presentation"><a href="#Intro" aria-controls="Intro" role="tab" data-toggle="tab">{{ $item->name2 }}</a></li>
            <li role="presentation"><a href="#History" aria-controls="History" role="tab" data-toggle="tab">{{ $item->name3 }}</a></li>
            <li role="presentation"><a href="#Organization" aria-controls="Organization" role="tab" data-toggle="tab">{{ $item->name4 }}</a></li>
            <li role="presentation"><a href="#Notice" aria-controls="Notice" role="tab" data-toggle="tab">{{ $item->name5 }}</a></li>
            <li role="presentation"><a href="#Environment" aria-controls="Environment" role="tab" data-toggle="tab">{{ $item->name6 }}</a></li>
            <li role="presentation"><a href="#File" aria-controls="File" role="tab" data-toggle="tab">檔案區</a></li>
            <li role="presentation"><a href="#Changename" aria-controls="Changename" role="tab" data-toggle="tab">修改標題</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="container">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Announcement">
                
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <vue-ckeditor name="announce" id="1" value="{{ $item->content1 }}" toolbar="luxury"></vue-ckeditor>
            <input type="hidden" name="kinds" value="1">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>

            
                </div>
                <div role="tabpanel" class="tab-pane" id="Intro">
            
           <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <vue-ckeditor name="intro" id="2" value="{{ $item->content2 }}" toolbar="luxury"></vue-ckeditor>
            <input type="hidden" name="kinds" value="2">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>
                        
                   
                </div>
                <div role="tabpanel" class="tab-pane" id="History">
                
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <vue-ckeditor name="history" id="3" value="{{ $item->content3 }}" toolbar="luxury"></vue-ckeditor>
            <input type="hidden" name="kinds" value="3">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>
            
                </div>
                <div role="tabpanel" class="tab-pane" id="Organization">
            
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <vue-ckeditor name="organization" id="4" value="{{ $item->content4 }}" toolbar="luxury"></vue-ckeditor>
            <input type="hidden" name="kinds" value="4">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>
           
                    
                </div>
                <div role="tabpanel" class="tab-pane" id="Notice">
            
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <vue-ckeditor name="notice" id="5" value="{{ $item->content5 }}" toolbar="luxury"></vue-ckeditor>
            <input type="hidden" name="kinds" value="5">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>       
                   
                </div>
                <div role="tabpanel" class="tab-pane" id="Environment">
            
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <vue-ckeditor name="environment" id="6" value="{{ $item->content6 }}" toolbar="luxury"></vue-ckeditor>
            <input type="hidden" name="kinds" value="6">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>
            
            
            
                </div>
                <div role="tabpanel" class="tab-pane" id="Changename">
                
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            
            <div class="form-group">
                <label >原標題: &nbsp {{ $item->name1 }}<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="name1"   value="{{ $item->name1 }}" >
            </div>
             <div class="form-group">
                <label >原標題: &nbsp {{ $item->name2 }}<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="name2"   value="{{ $item->name2 }}" >
            </div>
             <div class="form-group">
                <label >原標題: &nbsp {{ $item->name3 }}<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="name3"   value="{{ $item->name3 }}" >
            </div>
             <div class="form-group">
                <label>原標題: &nbsp {{ $item->name4 }}<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="name4"   value="{{ $item->name4 }}" >
            </div>
             <div class="form-group">
                <label >原標題: &nbsp {{ $item->name5 }}<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="name5"   value="{{ $item->name5 }}" >
            </div>
             <div class="form-group">
                <label >原標題: &nbsp {{ $item->name6 }}<span class="text-danger"></span></label>
                <input type="text" class="form-control" name="name6"   value="{{ $item->name6 }}" >
            </div>
            <input type="hidden" name="kinds" value="7">
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>
                
                </div>
            
            <div role="tabpanel" class="tab-pane" id="File">
            
            <form action="{{ $route }}" method="POST" role="form" enctype="multipart/form-data">    
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
             <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
            </form>
            
            
            </div>
            
            </div><!-- class="tab-content"-->
        </div><!--class="container" End-->
    </div><!-- role="tabpanel" End-->      
</div>
<!--Tabs End-->
@endsection
