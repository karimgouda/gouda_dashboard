<div class="col-xxl-9 col-xl-12 m-0 col-lg-12 col-md-12 col-sm-12">

    <div class="widget-content row widget-content-area blog-create-section">


        @foreach (App\Services\TranslatableService::getTranslatableInputs(App\Models\Blog::class) as $name => $data)
            <div class="col-md-6 mb-4">

                <label for="fullName">{{ translate('' . $name) }}
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

        @include('backend.partials._seotools');

    </div>



</div>

<div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
    <div class="widget-content widget-content-area blog-create-section">
        <div class="row">
            <div class="col-xxl-12 mb-4">
                <div class="switch form-switch-custom switch-inline form-switch-primary">
                    <input class="switch-input" type="checkbox" name="is_publish" role="switch" id="showPublicly"
                        {{(isset($row) && $row['is_publish'] == 0) ? '': 'checked'}}>
                    <label class="switch-label" for="showPublicly">{{translate('publish')}}</label>
                    @error('is_publish')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-xxl-12 col-md-12 mb-4">
                <label for="tags">{{translate('tags')}}</label>
                <input id="input-tags" value="{{isset($row) ? implode(',',json_decode($row['tags'],true)) :''}}" autocomplete="off" name="tags" placeholder="">
                @error('tags')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-xxl-12 col-md-12 mb-4">
                <label for="category">{{translate('categories')}}</label>
                <select id="select-category" name="categories[]" multiple placeholder="Select a categories..."
                    autocomplete="off">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ ( isset($blog_categories) && in_array($category->id,$blog_categories->pluck('id')->toArray())) ? 'selected' : '' }}> {{ $category->getTranslation('name', app()->getLocale()) }}
                        </option>
                    @endforeach
                </select>
                @error('categories.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-xxl-12 col-md-12 mb-4">

                <label for="product-images">{{translate('image')}}</label>
                <div class="multiple-file-upload">
                    <input type="file" class=" "  name="image" id="product-images" data-allow-reorder="true"
                        data-max-file-size="3MB" data-max-files="5">
                </div>
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                @if (isset($row))
                    @include('backend.partials._imageDetails', ['row' => $row]);
                @else
                    @include('backend.partials._imageDetails');

                @endif

            </div>

            <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                <button class="btn btn-success w-100">Create Post</button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        new TomSelect("#select-category");
        new TomSelect("#input-tags", {
            persist: false,
            createOnBlur: true,
            create: true
        });

    </script>

@endpush
