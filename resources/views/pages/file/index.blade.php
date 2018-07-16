@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<file-show-modal
    id="show-modal"
    :info="info"
></file-show-modal>

<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">{{ $theme }}</h1>
    </div>
    <div class="panel-body">
        <!-- duty select -->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-6 col-md-3 col-md-offset-9 col-lg-3 col-lg-offset-9">
                <select class="form-control"
                        v-model="selected"
                        @change="select('/folder/')">
                    <option disabled value="">請選擇</option>
                    @foreach ($options as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <br>

        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#files" aria-controls="files" role="tab" data-toggle="tab">檔案專區</a>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="files">
                    <table class="table table-hover" v-if="items.length > 0">
                        <thead>
                            <tr>
                                <th>標題</th>
                                <th>動作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items">
                                <td>@{{ item.title }}</td>
                                <td>
                                    <a  data-toggle="modal"
                                        class="btn btn-info"
                                        href='#show-modal'
                                        @click="getInfo('/file/'+item.id)"
                                    >檢視</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
