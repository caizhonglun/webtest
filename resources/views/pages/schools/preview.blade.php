@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $item->title }}</h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="list-group">
            <li class="list-group-item">
                <h4>教育部代碼</h4>
                <blockquote>{{ $item->e_no }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>機關代碼</h4>
                <blockquote>{{ $item->g_no }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>縣市</h4>
                <blockquote class="ql-editor">{{ $item->city }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>地區</h4>
                <blockquote>{{ $item->area }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>學校名</h4>
                <blockquote>{{ $item->name }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>學校名1</h4>
                <blockquote>{{ $item->name1 }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>學校名2</h4>
                <blockquote>{{ $item->name2 }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>英文學校名</h4>
                <blockquote>{{ $item->engName }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>是否私立</h4>
                <blockquote>{{ $item->private ? '私立' : '公立' }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>所屬分類</h4>
                <blockquote>{{ $sort }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>地址</h4>
                <blockquote>{{ $item->address }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>經緯度</h4>
                <blockquote>{{ $item->longitude }},{{ $item->latitude }}</blockquote>
            </li>
            <li class="list-group-item">
                <h4>地圖</h4>
                <div id="map" style="height: 400px;width: 100%;"></div>
            </li>
            <li class="list-group-item text-center">
                <a href="{{ route('schools.edit', $item->id) }}" class="btn btn-primary btn-lg">繼續修改</a>
                <a href="{{ route('schools.back') }}" class="btn btn-default btn-lg">確認</a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function initMap() {
        var uluru = {
            lat: {{ $item->longitude }},
            lng: {{ $item->latitude }}
        };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2JNg0FCB5AxF3f90suZVC0NuRiWt_mBw&callback=initMap"
    async defer></script>
@endsection
