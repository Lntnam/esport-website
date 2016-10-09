<div class="form-group">
    <label for="nameInput">Team Name</label>
    <input id="nameInput" type="text" class="form-control" name="name"
           value="{{ old('name', $model->name) }}"/>
</div>

<div class="form-group">
    <label for="short">Short Name</label>
    <input id="short" type="text" class="form-control" name="short"
           value="{{ old('short', $model->short) }}"/>
</div>

<div class="form-group">
    <label for="country">Country</label>
    {!! Form::select('country',
        \CountryList::getList(\App::getLocale()),
        old('country', $model->country),
        ['class'=>'form-control'])
    !!}
</div>
