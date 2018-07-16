@extends('layouts.backend')

@section('content')
<!-- 新增檔案 -->
<file-modal
    id="file-modal"
    :route="modal.route" :title="modal.title"
    :input="modal.data"  :folder_id="modal.folder_id"
></file-modal>

<!-- content -->
<div class="page-header">
    <h1>檔案專區 <small>{{ $theme }}</small></h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul>
            <li>請詳細描述您的檔案用途，以方便民眾查詢以及方便未來相關業務人員了解，謝謝您。</li>
            <li>目前僅提供pdf檔及zip壓縮檔上傳，如有需要請聯絡網站管理者。</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a role="tab">目錄</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active">
                    <ul class="list-group">
                        @foreach ($folders as $folder)
                        <file-folder
                            :id="{{ $folder['id'] }}"
                            :data="{{ json_encode($folder) }}" v-on:select="getInfo"></file-folder>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a role="tab">@{{ tabTitle }}檔案管理</a>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active">
                    <ul class="list-group" v-if="items">
                        <li class="list-group-item"
                            v-for="(item, index) in items"
                            :key="item.id">
                            <span class="glyphicon glyphicon-remove"
                                  aria-hidden="true" title="刪除"
                                  @click="deleteItem('/file/'+item.id, index)"
                            ></span>
                            @{{ item.title }}
                            <a data-toggle="modal" href='#file-modal'>
                                <span class="glyphicon glyphicon-pencil"
                                      aria-hidden="true"
                                      @click="showModal(
                                        '檢視檔案',
                                        '/file/' + item.id,
                                        item
                                      )"
                                ></span>
                            </a>

                        </li>
                        <li class="list-group-item">
                            <a data-toggle="modal" href='#file-modal'>
                                <span class="glyphicon glyphicon-plus"
                                      aria-hidden="true"
                                      @click="showModal(
                                        '新增檔案',
                                        '{{ route('file.store') }}'
                                      )"
                                > 新增檔案</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
