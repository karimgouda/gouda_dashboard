@foreach (App\Services\TranslatableService::getTranslatableInputs(App\Models\AboutUs::class) as $name => $data)
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

</div>
@endforeach

<div class="col-md-12 mb-12">

    <label for="fullName">{{ translate('creation_date') }}
            <span class="text-danger">*</span>
    </label>
    <input type="text" class="form-control inputs" name="creation_date"
           placeholder="" value="{{ old('creation_date', $row['creation_date'] ?? '') }}">
    @error('creation_date')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>


<div class="col-md-12">
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

    @include('backend.partials._seotools');

</div>


