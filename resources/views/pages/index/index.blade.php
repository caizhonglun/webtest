@extends('layouts.index')

@section('scripts')
<script type="text/javascript" src="https://alerts.ncdr.nat.gov.tw/temp/StaticFiles/Immediately/CapInfoNormal_66_180155.js"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/kfratJpfpLw" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            政策宣導
                            <small class="text-info"><a href="{{ route('policy.index') }}">more...</a></small>
                        </h3>
                    </div>
                    <ul class="list-group">
                        @foreach($policies as $item)
                        <li class="list-group-item">
                            <a href="{{ route('policy.show', $item->id) }}" target="_blank" title="{{ $item->title }}">{{ $item->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="panel panel-info">
   
                @if(count($maintain) > 0)
                    <div id= "changecolor" class="panel-heading">
                            <h3 id="changefont" class="panel-title" >
                                維護公告
                            </h3>
                        </div>
                    @foreach($maintain as $item)
                    <li>    
                        <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                    </li>
                    @endforeach
                            
                @else
                    <div class="panel-heading">
                        <h3 class="panel-title" >
                            維護公告
                        </h3>
                    </div>
                        暫無公告
                @endif
                <script>
                    var ScheduleDate = "{{ $item->announce_end}}", CurrentDate =  "{{date('Y-m-d')}}";

                    if( (Date.parse(ScheduleDate)).valueOf() < ((Date.parse(CurrentDate)).valueOf()+(5*1000 * 60 * 60 * 24)))
                    {
                    if ( (Date.parse(ScheduleDate)).valueOf() < ((Date.parse(CurrentDate)).valueOf()+(2*1000 * 60 * 60 * 24)))
                        {
                            document.getElementById("changecolor").style.backgroundColor = "red";
                            document.getElementById("changefont").style.color = "white";
                            document.getElementById("changefont").style.fontWeight= "bold";
                        }    
                    else
                        document.getElementById("changecolor").style.backgroundColor = "yellow";
                    }              
                </script>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">政府公開資訊</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            @foreach($publicInfo as $item)
                            <li>
                                <a href="{{ $item->url }}"
                                   target="_blank"
                                   title="{{ $item->title }}；承辦單位：{{ $item->organizer }},{{ $item->contact_phone }}"
                                   >{{ $item->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="carouselArea">
                @include('pages.index.partials.carousel')
            </div>
            @if(count($eduNews) > 0)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            教育新聞
                            <small class="text-info"><a href="{{ route('edunews.index') }}">more...</a></small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        @foreach($eduNews as $item)
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <a href="{{ route('edunews.show', $item->id) }}">
                                <img
                                    style="width: 150px; height: 100px"
                                    src="{{ asset($item->theme_img_path) }}"
                                    alt="{{ $item->title }}"
                                >
                            </a>
                            <h5>
                            <a href="{{ route('edunews.show', $item->id) }}">
                            {{ $item->title }}
                            </a>
                            </h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if(count($news) > 0)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            最新消息公告
                            <small class="text-info"><a href="{{ route('news.index') }}">more...</a></small>
                        </h3>
                    </div>
                    @include('pages.index.partials.news')
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="row">
            <!-- 災害示警資訊 -->
            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">災害示警</h3>
                    </div>

                    <div class="panel-body" style="height: 190px">
                        <div id="capInfo180155_Normal_66" ></div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 hidden-sm">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">單一認證及授權平台</h3>
                    </div>
                    <div class="panel-body">
                        <a href="https://sso.tyc.edu.tw/TYESSO/Login.aspx"
                           title="單一認證及授權平台" target="_blank">
                            <img src="{{ asset('/storage/css/lock.png') }}" alt="單一認證及授權平台">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
                        @include('pages.index.partials.advImg')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
