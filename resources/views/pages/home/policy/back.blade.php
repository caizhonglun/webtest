@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>政策宣導</h1>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"></div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a href="{{ route('policy.create') }}"
           class="btn btn-primary btn-lg btn-block"
        >新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>標題</th>
                    <th>顯示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        <a href="{{ route('policy.show', $item->id) }}"
                           target="_blank">{{ $item->title }}</a>
                    </td>
                    <td>
                        <toggle-button 
                            :value="{{ var_export($item->is_show) }}"
                            :sync="true" :labels="true"
                            @change="toggleShow('{{ route('policy.toggle', $item->id) }}')"

                        />
                    </td>
                    <td>
                        <a href="{{ route('policy.edit', $item->id) }}" class="btn btn-warning">修改</a>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('policy.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
