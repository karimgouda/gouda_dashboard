

<span data-bs-toggle="modal" style="cursor: pointer;" data-bs-target="#standardModal{{$query->id}}">{{\Str::limit($query->message, 50)}}</span>
<!-- Modal -->
<div class="modal fade modal-notification" id="standardModal{{$query->id}}" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="standardModalLabel">
        <div class="modal-content">
        <div class="modal-body text-center">
            <div class="icon-content">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>

            <p class="modal-text" style="white-space: break-spaces;">{{$query->message}}</p>
            </div>

        </div>
    </div>
</div>
