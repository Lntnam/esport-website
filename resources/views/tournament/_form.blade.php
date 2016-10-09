<div class="form-group">
    <label for="nameInput">Tournament</label>
    <input id="nameInput" type="text" class="form-control" name="name"
           value="{{ old('name', $model->name) }}"/>
</div>

<div class="form-group">
    <label for="short">Short Name</label>
    <input id="short" type="text" class="form-control" name="short"
           value="{{ old('short', $model->short) }}"/>
</div>

<div class="form-group">
    <label for="type">Type</label>
    {!! Form::select('type', ['onlan'=>'ONLAN', 'online'=>'ONLINE', 'other'=>'Other'], old('type', $model->type), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="homepage">Info URL</label>
    <input id="homepage" type="url" class="form-control" name="homepage"
           value="{{ old('homepage', $model->homepage) }}"/>
</div>

<div class="form-group">
    <label for="bracket">Bracket URL</label>
    <input id="bracket" type="url" class="form-control" name="bracket"
           value="{{ old('bracket', $model->bracket) }}"/>
</div>
