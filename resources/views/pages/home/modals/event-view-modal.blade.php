
@section('modals')
<div  id="calendar-event-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content b-a-0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                <h4 class="modal-title" id="calendar-event-title">Event</h4>
            </div>
            <div id="calendar-event-body" class="modal-body"></div>
        </div>
    </div>
</div>
@append