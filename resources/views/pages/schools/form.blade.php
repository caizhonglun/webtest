@extends('layouts.backend')

@section('content')
<div class="page-header">
    <h1>各級學校<small> {{ $theme }}</small></h1>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $route }}" method="POST" role="form">
            @if($isUpdate)
                {{ method_field('PATCH') }}
            @endif
            {{ csrf_field() }}
            <div class="form-group">
                <label for="e_no">教育部代碼</label>
                <input type="text" class="form-control" name="e_no"
                       value="{{ old('e_no', $item->e_no) }}" maxlength="255" />
            </div>
            <div class="form-group">
                <label for="g_no">機關代碼</label>
                <input type="text" class="form-control" name="g_no"
                       value="{{ old('g_no', $item->g_no) }}" maxlength="255" />
            </div>
            <div class="form-group">
                <label for="city">縣市<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="city"
                       value="{{ old('city', $item->city) }}" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="area">地區<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="area" value="{{ old('area', $item->area) }}" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="name">學校名<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="name1">學校名1<span class="text-danger">*</span></label>
                <input type="text" name="name1" class="form-control" value="{{ old('name1', $item->name1) }}" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="name2">學校名2<span class="text-danger">*</span></label>
                <input type="text" name="name2" class="form-control" value="{{ old('name2', $item->name2) }}" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="engName">英文學校名</label>
                <input type="text" name="engName" class="form-control" value="{{ old('engName', $item->engName) }}" maxlength="255" />
            </div>
            <div class="form-group">
                <label for="private">是否私立</label>
                <select name="private" id="private" class="form-control" required="required">
                    <option disabled value="">請選擇</option>
                    <option value="公立"
                        {{ !$item->private ? 'selected' : '' }}
                    >公立</option>
                    <option value="私立"
                        {{ $item->private ? 'selected' : '' }}
                    >私立</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sort_id">所屬分類</label>
                <select name="sort_id" class="form-control" required="required">
                    <option disabled value="">請選擇</option>
                    @foreach($sch_sorts as $option)
                    <option value="{{ $option->id }}"
                        {{ $option->id == $item->sort_id ? 'selected' : '' }}
                    >{{ $option->sort }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">地址</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $item->address) }}" maxlength="255" />
            </div>
            <div class="form-group">
                <label>經緯度</label>
                <div class="input-group">
                    <input type="text" name="longitude" class="form-control" placeholder="經度" value="{{ old('longitude', $item->longitude) }}">
                    <div class="input-group-addon">,</div>
                    <input type="text" name="latitude" class="form-control" placeholder="緯度" value="{{ old('latitude', $item->latitude) }}">
                </div>
            </div>
            <hr>
            <div class="form-group text-right">
                <a href="{{ route('schools.back') }}" class="btn btn-default btn-lg">返回</a>
                <button type="submit" class="btn btn-primary btn-lg">送出</button>
            </div>
        </form>
    </div>
</div>
@endsection