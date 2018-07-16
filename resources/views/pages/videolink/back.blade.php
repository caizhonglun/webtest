@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>影音宣導</h1>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        {{ $items->links() }}
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a href="{{ route('videolink.create') }}" class="btn btn-primary btn-lg btn-block">新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>影片</th>
                    <th>影片資訊</th>
                    <th>動作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ $item->url }}" target="__blank"><img src="{{ asset($item->img_path) }}" alt="{{ $item->title }}"></a></td>
                    <td>
                        <p>
                            標題：{{ $item->title }}<br>
                            申請單位：{{ $item->organizer }}<br>
                            聯絡電話：{{ $item->phone }}
                        </p>
                    </td>
                    <td>
                        <a href="{{ route('videolink.edit', $item->id) }}" class="btn btn-warning">修改</a>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('videolink.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection
