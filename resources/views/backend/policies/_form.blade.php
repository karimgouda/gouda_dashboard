@foreach (App\Services\TranslatableService::getTranslatableInputs(App\Models\Policy::class) as $name => $data)
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

<div class="col-md-6">
    <label for="link" class="form-label">{{ translate('type') }}</label>
    <select id="select" name="type"  placeholder="Select a categories..."
        autocomplete="off">
        <option value="privacy-policy" {{ ( isset($row) && $row['type'] == 'privacy-policy') ? 'selected' : '' }}> {{ translate('privacy-policy') }}
        <option value="usage-policy" {{ ( isset($row) && $row['type'] == 'usage-policy') ? 'selected' : '' }}> {{ translate('usage-policy') }}
        </option>
    </select>
    @error('type')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if (isset($row))
        @include('backend.partials._seotools', ['row' => $row]);
    @else
        @include('backend.partials._seotools');
    @endif

</div>

@push('scripts')
    <script>
        new TomSelect("#select");
    </script>

@endpush
