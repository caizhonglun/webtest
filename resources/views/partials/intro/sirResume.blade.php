<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">大頭貼</label>
    <vue-image-preview image-src="{{ asset($item->img_path) }}" id="thumbnail{{ $item->id }}"></vue-image-preview>
</div>

<legend>個人資訊</legend>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="name{{ $item->id }}">姓名<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="name" id="name{{ $item->id }}" value="{{ old('name', $item->name) }}" placeholder="姓名" maxlength="60" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">職位</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <p class="form-control-static">{{ $item->position }}</p>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="telephone{{ $item->id }}">電話<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="telephone" id="telephone{{ $item->id }}" value="{{ old('telephone', $item->telephone) }}" placeholder="電話" maxlength="13" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="telephone_extension{{ $item->id }}">分機<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="telephone_extension" id="telephone_extension{{ $item->id }}" value="{{ old('telephone_extension', $item->telephone_extension) }}" placeholder="分機" maxlength="9" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="direct_telephone{{ $item->id }}">專線<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="direct_telephone" id="direct_telephone{{ $item->id }}" value="{{ old('direct_telephone', $item->direct_telephone) }}" placeholder="專線" maxlength="13" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="fax{{ $item->id }}">傳真<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="text" class="form-control" name="fax" id="fax{{ $item->id }}" value="{{ old('fax', $item->fax) }}" placeholder="傳真" maxlength="13" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="email{{ $item->id }}">聯絡信箱<span class="text-danger">*</span></label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <input type="email" class="form-control" name="email" id="email{{ $item->id }}" value="{{ old('email', $item->email) }}" placeholder="聯絡信箱" required>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="education{{ $item->id }}">學歷</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <vue-ckeditor name="education" id="education{{ $item->id }}" value="{{ old('education', $item->education) }}" :height="300"></vue-ckeditor>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="experience{{ $item->id }}">經歷</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <vue-ckeditor name="experience" id="experience{{ $item->id }}" value="{{ old('experience', $item->experience) }}" :height="300"></vue-ckeditor>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" for="honor{{ $item->id }}">榮耀</label>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
        <vue-ckeditor name="honor" id="honor{{ $item->id }}" value="{{ old('honor', $item->honor) }}" :height="300"></vue-ckeditor>
    </div>
</div>
