<div class="col-md-12">
    <label for="name" class="form-label">{{ translate('name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $row['name'] ?? '') }}" id="name">
    @error('name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="row mt-5">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4>{{ translate('permissions') }}</h4>
        <div class="form-check form-check-primary d-block new-control">
            <input class="form-check-input child-chk" name="check_all" type="checkbox"
            id="check_all">
            <label class="form-check-label" for="check_all">{{ translate('Check All') }}</label>

        </div>
    </div>

</div>
@foreach ($permissions as $permission)
    <div class="col-md-2">
        <div class="form-check form-switch form-check-inline">
            <input class="form-check-input child" type="checkbox" role="switch" name="permissions[]"
                value="{{ $permission->name }}" id="{{ $permission->name }}"
                {{ (isset($row) && in_array($permission->name, $row->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $permission->name }}">{{ $permission->name }}</label>
        </div>
    </div>
@endforeach

@push('scripts')
    <script>
        $(function() {
            $("#check_all").click(function(){
                $('input:checkbox.child').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endpush
