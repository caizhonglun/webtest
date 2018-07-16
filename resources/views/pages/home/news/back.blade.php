@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>最新消息公告</h1>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">{{ $items->links() }}</div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a href="{{ route('news.create') }}"
           class="btn btn-primary btn-lg btn-block"
        >新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>類別</th>
                    <th>公告起訖日</th>
                    <th>標題</th>
                    <th>顯示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->sort }}</td>
                    <td>{{ $item->announce_start }}～{{ $item->announce_end }}</td>
                    <td>
                        <a href="{{ route('news.show', $item->id) }}"
                           title="{{ $item->title }}"
                           target="_blank">
                           {{ mb_strlen($item->title, 'utf-8') > 20 ? mb_substr($item->title, 0, 20, 'utf-8') . '...' : $item->title }}
                       </a>
                    </td>
                    <td>
                        <toggle-button 
                            :value="{{ var_export($item->is_show) }}"
                            :sync="true" :labels="true"
                            @change="toggleShow('{{ route('news.toggle', $item->id) }}')"

                        />
                    </td>
                    <td>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning">修改</a>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('news.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection
