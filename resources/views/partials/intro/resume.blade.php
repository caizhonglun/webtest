<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">大頭貼</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <vue-image-preview
            image-src="{{ $personalDuty->img_path ? asset($personalDuty->img_path) : asset('/storage/001.jpg') }}"
            id="thumbnail"></vue-image-preview>
    </div>
</div>

<legend>個人資訊</legend>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="name">姓名<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $personalDuty->name) }}" placeholder="姓名" maxlength="60" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="inputUnit">科室<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        @if(in_array($personalDuty->position, ['局長', '副局長', '主任秘書']))
        <p class="form-control-static">{{ session('nowDutyName') }}</p>
        @else
        <select name="unitID" id="inputUnitID" class="form-control" required="required">
            <option value="">請選擇</option>
            @foreach ($units as $unit)
                <option 
                    value="{{ $unit->id }}"
                    {{ $unit->id == old('unitID', session('nowDutyID')) ? 'selected' : '' }}
                >{{ $unit->name2 }}</option>
            @endforeach
        </select>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">職位<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="position" id="position" value="{{ old('position', $personalDuty->position) }}" placeholder="職位名稱" maxlength="60" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="telephone">電話<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone', $personalDuty->telephone) }}" placeholder="電話" maxlength="13" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="telephone_extension">分機</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="telephone_extension" id="telephone_extension" value="{{ old('telephone_extension', $personalDuty->telephone_extension) }}" placeholder="分機" maxlength="9">
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="direct_telephone">專線</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="direct_telephone" id="direct_telephone" value="{{ old('direct_telephone', $personalDuty->direct_telephone) }}" placeholder="專線" maxlength="13">
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="fax">傳真</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="fax" id="fax" value="{{ old('fax', $personalDuty->fax) }}" placeholder="傳真" maxlength="13">
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="email">聯絡信箱</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $personalDuty->email) }}" placeholder="聯絡信箱" maxlength="255">
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="agent">代理人</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="agent" id="agent" value="{{ old('agent', $personalDuty->agent) }}" placeholder="代理人" maxlength="255">
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="duty">業務內容</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <vue-ckeditor name="duty" id="duty" value="{{ old('duty', $personalDuty->duty) }}" :height="300"></vue-ckeditor>
    </div>
</div>
