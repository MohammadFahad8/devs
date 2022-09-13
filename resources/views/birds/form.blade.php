
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($birds)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <label for="body" class="col-md-2 control-label">Body</label>
    <div class="col-md-10">
        <input class="form-control" name="body" type="text" id="body" value="{{ old('body', optional($birds)->body) }}" minlength="1" placeholder="Enter body here...">
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>
</div>

