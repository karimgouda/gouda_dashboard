<div class="mt-5">
    <div class="h4">{{ translate('SEO Tools') }}</div>
    <div class="row">

        <div class="col-md-11 mx-auto">
            <div class="row">

                {{-- Begin Open Graph Inputs --}}
                <div class="form-group mt-4">
                    <label for="og_type">{{translate('Open Graph Type')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['og_type']) ? $row['og_type'] : old('og_type')}}"  name="og_type" id="og_type" data-allow-reorder="true" />
                    @error('og_type')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="og_title">{{translate('Open Graph Title')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['og_title']) ? $row['og_title'] : old('og_title')}}"  name="og_title" id="og_title" data-allow-reorder="true" />
                    @error('og_title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="og_url">{{translate('Open Graph URL')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['og_url']) ? $row['og_url'] : old('og_url')}}"  name="og_url" id="og_url" data-allow-reorder="true" />
                    @error('og_url')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="og_description">{{translate('Open Graph Description')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['og_description']) ? $row['og_description'] : old('og_description')}}"  name="og_description" id="og_description" data-allow-reorder="true" />
                    @error('og_description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="og_image">{{translate('Open Graph Image')}}</label>
                    <input type="file" class="form-control"  name="og_image" id="og_image" data-allow-reorder="true" />
                    @error('og_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- End Open Graph Inputs --}}


                <hr>
                

                {{-- Begin Twitter Inputs --}}
                <div class="form-group mt-4">
                    <label for="twitter_card">{{translate('Twitter Card')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['twitter_card']) ? $row['twitter_card'] : old('twitter_card')}}"  name="twitter_card" id="twitter_card" data-allow-reorder="true" />
                    @error('twitter_card')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="twitter_title">{{translate('Twitter Title')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['twitter_title']) ? $row['twitter_title'] : old('twitter_title')}}"  name="twitter_title" id="twitter_title" data-allow-reorder="true" />
                    @error('twitter_title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="twitter_site">{{translate('Twitter Site')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['twitter_site']) ? $row['twitter_site'] : old('twitter_site')}}"  name="twitter_site" id="twitter_site" data-allow-reorder="true" />
                    @error('twitter_site')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="twitter_description">{{translate('Twitter Description')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['twitter_description']) ? $row['twitter_description'] : old('twitter_description')}}"  name="twitter_description" id="twitter_description" data-allow-reorder="true" />
                    @error('twitter_description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="twitter_image">{{translate('Twitter Image')}}</label>
                    <input type="file" class="form-control"  name="twitter_image" id="twitter_image" data-allow-reorder="true" />
                    @error('twitter_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="twitter_image_alt">{{translate('Twitter Image Alt')}}</label>
                    <input type="text" class="form-control" value="{{ isset($row['twitter_image_alt']) ? $row['twitter_image_alt'] : old('twitter_image_alt')}}"  name="twitter_image_alt" id="twitter_image_alt" data-allow-reorder="true" />
                    @error('twitter_image_alt')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- End Twitter Inputs --}}

            </div>
        </div>


    </div>
</div>
