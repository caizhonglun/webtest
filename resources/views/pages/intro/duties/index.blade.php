@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">各科室業務簡介 <small>Duties</small></h1>
    </div>
    <div class="panel-body">
        <!-- duty select -->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-6 col-md-3 col-md-offset-9 col-lg-3 col-lg-offset-9">
                <select class="form-control" v-model="selected" @change="selectDuty()">
                    <option disabled value="">請選擇</option>
                    @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name1 }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <br>

        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#duty" aria-controls="home" role="tab" data-toggle="tab">業務職掌</a>
                </li>
                <li role="presentation">
                    <a href="#personalDuty" aria-controls="tab" role="tab" data-toggle="tab">人員職掌</a>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="duty">
                    <!-- duty content -->
                    <div v-html="duty.content"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="personalDuty">
                    <br>
                    <!-- personal list -->
                    <div class="media" v-for="item in duty.list">
                        <div class="media-body">
                            <h4 class="media-heading">@{{ item.name }}</h4>
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                <p>
                                    職位：@{{ item.position }} <br>
                                    電話：@{{ item.telephone }}<br>
                                    分機：@{{ item.telephone_extension }}<br>
                                    專線：@{{ item.direct_telephone }}<br>
                                    傳真：@{{ item.fax }}<br>
                                    聯絡信箱：@{{ item.email }}<br>
                                    代理人：@{{ item.agent }}
                                </p>
                            </div>
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                <p>
                                    業務內容：<br>
                                    <div v-html="item.duty"></div>
                                </p>
                            </div>
                        </div>
                        <div class="media-right">
                            <img class="media-object" style="height: 200px" :src="item.img_path" alt="Image" v-show="item.img_path">
                        </div>
                        <hr>
                    </div>
                    <!-- end list -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
