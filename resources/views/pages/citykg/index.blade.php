@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<!--Tabs Start=====================================================================================-->
<div class="panel panel-info">
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
        <div class="panel-body">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Announcement">
                     <div class="panel-body">{!! $item->content1 !!}</div>
                 
                </div>
                <div role="tabpanel" class="tab-pane" id="Intro">
                   
                <div class="panel-body">{!! $item->content2 !!}</div>
                   
                </div>
                <div role="tabpanel" class="tab-pane" id="History">
                    
                 
                <div class="panel-body">{!! $item->content3 !!}</div>  
                 
                </div>
                <div role="tabpanel" class="tab-pane" id="Organization">
                    
                <div class="panel-body">{!! $item->content4 !!}</div> 
                 
                </div>
                <div role="tabpanel" class="tab-pane" id="Notice">
                   
                <div class="panel-body">{!! $item->content5 !!}</div>
                
                </div>
                <div role="tabpanel" class="tab-pane" id="Environment">
                
                <div class="panel-body">{!! $item->content6 !!}</div>
                    
                </div>
            </div><!-- class="tab-content"-->
        </div><!--class="container" End-->
    </div><!-- role="tabpanel" End-->      
</div>
<!--Tabs End-->
</div>
@endsection
