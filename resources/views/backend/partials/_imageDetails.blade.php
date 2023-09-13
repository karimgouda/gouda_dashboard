<div class="form-group mt-4">
    <label for="tags">{{translate('image name')}}</label>
    <input type="text" class="form-control" value="{{ isset($row['image']) ? image_name($row['image']) : old('image')}}"  name="image_name" id="image_name" data-allow-reorder="true" />
    @error('image_name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mt-4">
    <label for="tags">{{translate('image title')}}</label>
    <input type="text" class="form-control" value="{{ isset($row['image_title']) ? $row['image_title'] : old('image_title')}}"  name="image_title" id="image_title" data-allow-reorder="true" />
    @error('image_title')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mt-4">
    <label for="tags">{{translate('image alt')}}</label>
    <input type="text" class="form-control" value="{{ isset($row['image_alt']) ? $row['image_alt'] : old('image_alt')}}"  name="image_alt" id="image_alt" data-allow-reorder="true" />
    @error('image_alt')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
