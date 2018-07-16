@extends('layouts.backend')

@section('content')
<!-- 新增影音 -->
<video-new-modal
    id="modal-add"
    route="{{ route('video.store') }}"
></video-new-modal>

<!-- content -->
<div class="page-header">
    <h1>廉政服務專區 <small>{{ $theme }}</small></h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul>
            <li>此平台不提供上傳影片功能，請先將您的影片上傳至youtube，並複製連結至此。</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">{{ $items->links() }}</div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a data-toggle="modal"
           href="#modal-add"
           class="btn btn-primary btn-lg btn-block"
        >新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>排序</th>
                    <th>標題</th>
                    <th>影片</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr id="row{{ $item->id }}">
                    <td>
                        <span class="glyphicon glyphicon-menu-up"
                              aria-hidden="true"
                              @click="up({{ $item->id }}, '/video/number1/priority/number2')"></span>
                        <br>
                        <span class="glyphicon glyphicon-menu-down"
                              aria-hidden="true"
                              @click="down({{ $item->id }}, '/video/number1/priority/number2')"></span>
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <video width="320" height="240" controls>
                            <source src="{{ asset($item->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('video.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection
