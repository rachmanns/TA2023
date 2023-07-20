<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="role_name" type="text" id="name" value="{{ isset($role->name) ? $role->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    <input type="hidden" name="role_id" value="{{ isset($role->id) ? $role->id : ''}}">
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Add New' }}">
</div>
