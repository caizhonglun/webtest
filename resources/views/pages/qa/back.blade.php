@extends('layouts.backend')

@section('content')
<qa-modal
    id="modal-qa"
    title="test"
    :title="modal.title"
    :route="modal.route"
    :data="modal.data"
></qa-modal>

<div class="page-header">
    <h1>{{ $theme }}</h1>
</div>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">{{ $items->links() }}</div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a class="btn btn-primary btn-lg btn-block" data-toggle="modal" href="#modal-qa"
            @click="showModal('新增')">新增</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>標題</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('qa.show', $item->id) }}"
                           title="{{ $item->title }}"
                           target="_blank">{{ $item->title }}</a>
                    </td>
                    <td>
                        <a class="btn btn-warning" data-toggle="modal" href="#modal-qa"
                            @click="showModal('修改', '{{ route('qa.update', $item->id) }}', {{ json_encode($item) }})"
                        >修改</a>
                        <button type="button" class="btn btn-danger"
                        @click="deleteItem('{{ route('qa.destroy', $item->id) }}')">刪除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection
