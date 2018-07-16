@extends('layouts.backend')

@section('content')
<section-form-modal
    id="modal-id"
    :title="modal.title"
    :route="modal.route"
    :input="modal.data"
></section-form-modal>

<div class="page-header">
    <h1>組織業務人員簡介</h1>
</div>
<div class="row">
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"></div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <a class="btn btn-primary btn-block btn-lg"
           data-toggle="modal" href='#modal-id'
           @click="showModal('新增科室', '{{ route('duty.store') }}')">新增科室</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>＃</th>
                    <th>排序</th>
                    <th>科室</th>
                    <th>顯示</th>
                    <th>動作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $item)
                <tr id="row{{ $item->id }}">
                    <td>
                        <span class="glyphicon glyphicon-menu-up"
                              aria-hidden="true"
                              @click="up({{ $item->id }}, '/duty/number1/priority/number2')"></span>
                        <br>
                        <span class="glyphicon glyphicon-menu-down"
                              aria-hidden="true"
                              @click="down({{ $item->id }}, '/duty/number1/priority/number2')"></span>
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name1 }}</td>
                    <td>
                        <toggle-button 
                            :value="{{ var_export($item->is_show) }}"
                            :sync="true" :labels="true"
                            @change="toggleShow('{{ route('duty.toggle', $item->id) }}')"
                        />
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="#modal-id"
                               data-toggle="modal"
                               @click="showModal('科室執掌', '{{ route('duty.update', $item->id) }}', {{ json_encode($item->toArray()) }})"
                               class="btn btn-info">科室執掌</a>
                            <a href="{{ route('personalduty.back', $item->id) }}"
                               class="btn btn-success">人員執掌</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
