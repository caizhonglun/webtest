@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="panel-title">最新消息公告</h1>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>類別</th>
                        <th>標題</th>
                        <th>公告日期</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->sort }}</td>
                        <td>
                            <a href="{{ route('news.show', $item->id) }}"
                            title="{{ $item->title }}"
                            >{{ $item->title }}
                            </a>
                        </td>
                        <td>{{ $item->announce_start }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>
</div>
@endsection