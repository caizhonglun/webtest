@extends('layouts.page')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">個資保護公開作業</h1>
    </div>
    <div class="panel-body">
        <!-- duty select -->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-6 col-md-3 col-md-offset-9 col-lg-3 col-lg-offset-9">
                <select class="form-control" v-model="selected" @change="select('/pdata/')">
                    <option disabled value="">請選擇</option>
                    @foreach ($units as $unit)
                    <option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>科室</th>
                            <th>檔案名稱</th>
                            <th>保有依據</th>
                            <th>特定目的</th>
                            <th>個人資料別</th>
                            <th>保有單位</th>
                        </tr>
                    </thead>
                    <tbody id="serTr">
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->accordance }}</td>
                            <td>{{ $item->purpose }}</td>
                            <td>{{ $item->p_data_sort }}</td>
                            <td>{{ $item->keep_unit }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr v-for="(item, index) in items">
                            <td>@{{ index+1 }}</td>
                            <td>@{{ item.unit }}</td>
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.accordance }}</td>
                            <td>@{{ item.purpose }}</td>
                            <td>@{{ item.p_data_sort }}</td>
                            <td>@{{ item.keep_unit }}</td>
                        </tr>
                    </tfoot>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
