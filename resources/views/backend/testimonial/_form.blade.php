@foreach (App\Services\TranslatableService::getTranslatableInputs(App\Models\Testimonial::class) as $name => $data)
    <div class="col-md-6 mb-4">
        <label for="fullName">{{ translate(''.$name) }}
            @if (str_contains($data['validations'], 'required'))
                <span class="text-danger">*</span>
            @endif
        </label>

        @if ($data['is_textarea'])
            @include('backend.partials._textarea', [
                'name' => "$name",
                'data' => $data,
            ])
        @else
            @include('backend.partials._input', [
                'name' => "$name",
                'data' => $data,
            ])
        @endif
        @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
@endforeach
<div class="col-md-6 mb-4">
    <label>{{translate('Rate')}}
        <span class="text-danger">*</span>
    </label>
    <input type="number" class="form-control"  name="rate" data-allow-reorder="true">
    @error('rate')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
<div class="col-md-6 mb-4">
    <label>{{translate('Image')}}
        <span class="text-danger">*</span>
    </label>
    <input type="file" class="form-control" name="image" data-allow-reorder="true"
           data-max-file-size="3MB" data-max-files="3">
    @error('image')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
