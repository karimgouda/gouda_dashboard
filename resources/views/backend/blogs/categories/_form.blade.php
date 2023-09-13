@foreach (App\Services\TranslatableService::getTranslatableInputs(App\Models\BCategory::class) as $name => $data)
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

