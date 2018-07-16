@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="/schools/searchSch" method="POST" class="form-inline" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="sr-only">請輸入學校關鍵字</label>
                        <auto-complete></auto-complete>
                    </div>
                    <button type="submit" class="btn btn-primary">查詢</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="panel-title">{{ $theme }}</h1>
            </div>
            <div class="panel-body">
                <div id="map" style="height: 400px;width: 100%;"></div>
                <table class="table table-hover">
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->area }}</td>
                            <td>
                                <a href='#map'
                                    onclick="showSchoolMap('{{ $item->name2 }}', {{ $item->longitude }}, {{ $item->latitude }})"
                                >{{ $item->name2 }}</a>
                            </td>
                            <td>{{ $item->address }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var map;

    function initMap() {
        var uluru = {
            lat: 24.993103,
            lng: 121.301049
        };
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
    }

    var showSchoolMap = function(title, longitude, latitude) {
        var uluru = {
            lat: longitude,
            lng: latitude
        };
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
    };
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2JNg0FCB5AxF3f90suZVC0NuRiWt_mBw&callback=initMap"
    async defer></script>
@endsection
