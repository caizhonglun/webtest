@extends('layouts.backend')

@section('content')
<!-- link modal -->
<link-modal
    id="modal-link"
    :title="modal.title" :route="modal.route"
    :input="modal.data"  :sort_id="modal.sort_id"
></link-modal>

<!-- sort modal -->
<link-sort-modal
    id="modal-sort" theme="{{ $theme }}"
    :title="modal.title" :route="modal.route"
    :input="modal.data"
></link-sort-modal>

<!-- content -->
<div class="page-header">
    <h1>{{ $theme }}</h1>
</div>
<div class="row">
<!-- 類別 -->
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#sorts" aria-controls="sorts" role="tab" data-toggle="tab">類別</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="sorts">
                <ul class="list-group">
                    @foreach($items as $item)
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-remove"
                              aria-hidden="true" title="刪除"
                              @click="deleteItem('{{ route('linksort.destroy', $item->id) }}')"
                        ></span>
                        {{ $item->name }}
                        <span class="glyphicon glyphicon-chevron-right"
                              aria-hidden="true" title="顯示連結"
                              @click="getInfo(
                                '{{ route('linksort.show', $item->id) }}',
                                '{{ $item->id }}')"
                        ></span>
                    </li>
                    @endforeach
                    <li class="list-group-item">
                        <a data-toggle="modal" href='#modal-sort'
                           @click="showModal('新增類別', '{{ route('linksort.store') }}')"
                        ><span class="glyphicon glyphicon-plus" aria-hidden="true"> 新增類別</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 連結 -->
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#links" aria-controls="links" role="tab" data-toggle="tab">連結</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="links !== null">
                <ul class="list-group" v-if="items">
                    <li class="list-group-item"
                        v-for="(item, key) in items"
                        :key="item.id">
                        <span class="glyphicon glyphicon-remove"
                              aria-hidden="true" title="刪除"
                              @click="deleteItem('/link/'+item.id, key)"
                        ></span>
                        <a :href="item.url" target="_blank">@{{ item.title }}</a>
                        <a data-toggle="modal" href='#modal-link'>
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="修改" @click="showModal('修改連結', '/link/'+item.id, item)"></span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a data-toggle="modal" href='#modal-link'><span class="glyphicon glyphicon-plus" aria-hidden="true" @click="showModal('新增連結', '{{ route('link.store') }}')"> 新增連結</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
