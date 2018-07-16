@extends('layouts.backend')

@section('content')
<pdata-model
    id="model-form"
    title="test"
    :title="modal.title"
    :route="modal.route"
    :data="modal.data"
></pdata-model>

<div class="page-header">
    <h1>{{ $theme }}</h1>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        {{ $items->links() }}
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a class="btn btn-primary btn-lg btn-block" data-toggle="modal" href='#model-form'
            @click="showModal('新增')">新增</a>
    </div>
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
                    <th>動作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->accordance }}</td>
                    <td>{{ $item->purpose }}</td>
                    <td>{{ $item->p_data_sort }}</td>
                    <td>{{ $item->keep_unit }}</td>
                    <td>
                        <a class="btn btn-warning" data-toggle="modal" href='#model-form'
                            @click="showModal('修改', '{{ route('pdata.update', $item->id) }}', {{ json_encode($item) }})">修改</a>
                        <button type="button" class="btn btn-danger"
                            @click="deleteItem('{{ route('pdata.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>

@endsection
