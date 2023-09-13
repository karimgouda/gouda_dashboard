

<div class="col-md-6 mb-12">

    <label for="fullName">{{ translate('name') }}
            <span class="text-danger">*</span>
    </label>
    <input type="text" class="form-control inputs" name="name"
           placeholder="" value="{{ old('name', $row->name ?? '') }}">
    @error('name')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-12">

    <label for="fullName">{{ translate('email') }}
            <span class="text-danger">*</span>
    </label>
    <input type="text" class="form-control inputs" name="email"
           placeholder="" value="{{ old('email', $row->email ?? '') }}">
    @error('email')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
<div class="col-md-6 mb-12">

    <label for="fullName">{{ translate('password') }}
            <span class="text-danger">*</span>
    </label>
    <input type="text" class="form-control inputs" name="password"
           placeholder="" value="{{ old('password') }}">
    @error('password')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>





