<div id="post-task-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Post for Task</h5>       
            </div>
            <div class="modal-body">
                <form id="task-post-form" class="fields-container">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <input id="show-in-calendar" type="checkbox" class="js-switch" checked> <span class="m-l-1">Show in Calendar?</span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Task To Post (TODO: add field names)</label>
                                <select name="task_id" required class="form-control select2-input"></select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Post Text</label>
                                <textarea id="new-post-textarea" class="form-control" placeholder="Text to display in the post"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Deadline</label>
                                <input required name="date_time_to" type="date" class="form-control">
                            </div>

                        </div> 
                    </div> 

                </form>
            </div>
            <div class="modal-footer">
                <button id="action-post" type="button" class="btn btn-primary">
                    <i class="fa fa-save"></i> Post
                </button>
            </div>
        </div>
    </div>
</div>