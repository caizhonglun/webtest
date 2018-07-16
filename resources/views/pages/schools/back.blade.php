@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>{{ $theme }}</h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="/schools/search" method="POST" class="form-inline" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="sr-only" for="keyWord">關鍵字</label>
                        <auto-complete></auto-complete>
                    </div>
                    <button type="submit" class="btn btn-primary">查詢</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">{{ $items->links() }}</div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a href="{{ route('schools.create') }}"
           class="btn btn-primary btn-lg btn-block"
        >新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>縣市</th>
                    <th>地區</th>
                    <th>學校名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->area }}</td>
                    <td>{{ $item->name2 }}</td>
                    <td>
                        <a href="{{ route('schools.edit', $item->id) }}" class="btn btn-warning">修改</a>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('schools.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection
