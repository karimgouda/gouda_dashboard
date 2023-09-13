
<div class="col-md-6">
    <label for="name" class="form-label">{{ translate('name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $row['name'] ?? '') }}" id="name">
    @error('name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6">
    <label for="email" class="form-label">{{ translate('email') }}</label>
    <input type="text" class="form-control" name="email" value="{{ old('email', $row['email'] ?? '') }}" id="email">
    @error('email')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6">
    <label for="password" class="form-label">{{ translate('password') }}</label>
    <input type="text" class="form-control" name="password" value="{{ old('password',  '') }}" id="password">
    @error('password')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
<div class="col-md-6">
    <label for="password_confirmation" class="form-label">{{ translate('password_confirmation') }}</label>
    <input type="text" class="form-control" name="password_confirmation" value="{{ old('password_confirmation','') }}" id="name">
    @error('password_confirmation')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
<div class="col-md-6">
    <label for="image" class="form-label">{{ translate('image') }}
        <span class="text-danger">*</span>
    </label>
    {{-- file-upload-multiple --}}
    <input type="file" class="form-control" name="image" data-allow-reorder="true"
        data-max-file-size="3MB" data-max-files="3">
    @error('image')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if (isset($row))
        @include('backend.partials._imageDetails', ['row' => $row]);
    @else
        @include('backend.partials._imageDetails');
    @endif

</div>
<div class="col-md-6">
    <label for="role">{{translate('roles')}}</label>
    <select id="select-role" name="roles[]" multiple placeholder="Select a roles..."
    autocomplete="off">
    @foreach ($roles as $role)
            <option value="{{ $role->name }}" {{ ( isset($row['roles']) && in_array($role->name,array_column($row['roles'],'name'))) ? 'selected' : '' }}>
                 {{ $role->name }}
            </option>
        @endforeach
    </select>
    @error('roles.*')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>


@push('scripts')
    <script>
        new TomSelect("#select-role");
    </script>

@endpush
