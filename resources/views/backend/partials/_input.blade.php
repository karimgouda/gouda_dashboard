<input type="{{$data['type']}}" class="form-control inputs" name="{{ $name }}"
        placeholder="" value="{{ old($name, $row[$name] ?? '') }}">
@error($name)
<div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
