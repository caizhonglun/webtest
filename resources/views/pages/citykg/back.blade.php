@extends('layouts.backend')

@section('content')
<!--Tabs Start=====================================================================================-->
<div class="container-filud" id="tabs">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Announcement" aria-controls="Announcement" role="tab" data-toggle="tab">本園公告</a></li>
            <li role="presentation"><a href="#Intro" aria-controls="Intro" role="tab" data-toggle="tab">園長簡介</a></li>
            <li role="presentation"><a href="#History" aria-controls="History" role="tab" data-toggle="tab">歷史沿革</a></li>
            <li role="presentation"><a href="#Organization" aria-controls="Organization" role="tab" data-toggle="tab">組織架構及職掌</a></li>
            <li role="presentation"><a href="#Notice" aria-controls="Notice" role="tab" data-toggle="tab">入園須知</a></li>
            <li role="presentation"><a href="#Environment" aria-controls="Environment" role="tab" data-toggle="tab">環境介紹</a></li>
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
            </div><!-- class="tab-content"-->
        </div><!--class="container" End-->
    </div><!-- role="tabpanel" End-->      
</div>
<!--Tabs End-->
@endsection
