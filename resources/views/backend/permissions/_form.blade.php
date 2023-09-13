
<div class="col-md-12">
    <label for="name" class="form-label">{{ translate('name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $row['name'] ?? '') }}" id="name">
    @error('name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

