<textarea name="{{ $name }}" class="tinymce-editor form-control" id="textearea{{$name}}"   rows="5">{{ old($name, $row[$name] ?? '') }}</textarea>
@error($name)
<div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
