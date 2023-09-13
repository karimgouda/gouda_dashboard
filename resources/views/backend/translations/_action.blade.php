
<form class="row g-4" method="POST"  id="formTranslation{{$query->id}}" action="" >
        @csrf
        <div class="col-10">

        <input type="text" class="form-control" name="lang_value" value="{{$query->lang_value}}">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success saveTranslation" id="{{$query->id}}">{{ translate('save') }}</button>
        </div>
</form>


