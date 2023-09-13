<div class="dropdown">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
        <a class="dropdown-item" href="#">{{translate('view')}}</a>
        <a class="dropdown-item" href="{{route('blogs.edit',$id)}}">{{translate('edit')}}</a>
        <form id="delete-form" action="{{ route('blogs.destroy', $id) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class=" delete dropdown-item">
                {{translate('delete')}}
            </button>
        </form>
    </div>
</div>
