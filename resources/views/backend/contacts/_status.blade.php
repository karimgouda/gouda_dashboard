<div class="btn-group w-100" role="group">
    @php
        if($query->status == 'new'){
            $badge = 'info';
        }elseif ($query->status == 'viewed') {
            $badge = 'secondary';
        }elseif ($query->status == 'in_progress') {
            $badge = 'warning';
        }elseif ($query->status == 'done') {
            $badge = 'success';
        }
    @endphp
    <button id="btnGroupVerticalDrop2" type="button" class="btn btn-{{$badge}} dropdown-toggle  _effect--ripple waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
        {{translate(''.$query->status)}}

     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2" style="">
        @foreach (App\Enums\ContactStatusEnum::values() as $key => $status)
            @if ($status != $query->status)
                <li>

                    <a class="dropdown-item" href="{{url("admin/contact-us/update-status/$query->id/$status")}}">
                              {{translate(''.$status)}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
