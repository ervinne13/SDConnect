
@section('js')
<script src="{{url("js/views/group/join-group-view.js")}}"></script>
@append

@section('modals')

<div id="join-group-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content b-a-0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                <h4 class="modal-title">Join a new Group</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="input-group-code">Group Code</label>
                            <input name="code" id="input-group-code" required placeholder="Ask the group owner for the group code. Ex. (IT-SAD-2017-204)" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            @include('views.loader.rainbow')
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button id="action-join-group" class="btn btn-primary">
                        Join Group
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@append