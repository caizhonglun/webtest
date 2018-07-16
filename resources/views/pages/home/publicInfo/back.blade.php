@extends('layouts.backend')

@section('content')
<!-- 新增修改視窗 -->
<link-modal id="modal-form" :title="modalTitle" :route="modalRoute" :input="modalData"></link-modal>

<div class="page-header">
    <h1>政府資訊公開</h1>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"></div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a class="btn btn-primary btn-lg btn-block"
           data-toggle="modal" href='#modal-form'
           @click="showModal('新增', '{{ route('publicinfo.store') }}')">新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>連結</th>
                    <th>資訊</th>
                    <th>動作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ $item->url }}" target="__blank">{{ $item->title }}</td>
                    <td>
                        <p>
                            承辦單位：{{ $item->organizer }}<br>
                            聯絡電話：{{ $item->contact_phone }}
                        </p>
                    </td>
                    <td>
                        <a href="#modal-form" data-toggle="modal" class="btn btn-warning"
                           @click="showModal('修改', '{{ route('publicinfo.update', $item->id) }}', {{ json_encode($item->toArray()) }})"
                           >修改</a>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('publicinfo.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
