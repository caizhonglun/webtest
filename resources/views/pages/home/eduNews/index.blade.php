@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="panel-title">教育新聞</h1>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>圖片</th>
                        <th>標題</th>
                        <th>活動日期</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <a href="{{ route('edunews.show', $item->id) }}">
                            <img style="width: 150px; height: 100px" 
                                 src="{{ asset($item->theme_img_path) }}"
                                 alt="{{ $item->title }}">
                            </a>
                        </td>
                        <td><a href="{{ route('edunews.show', $item->id) }}">{{ $item->title }}</a></td>
                        <td>{{ $item->activity_start }}～{{ $item->activity_start }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>
</div>
@endsection