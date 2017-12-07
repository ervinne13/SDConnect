<div id="post-task-modal" class="modal fade" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Post for Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="group-form" class="fields-container">

          {{ csrf_field() }}

          <div class="row">
              <div class="col-md-12">
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
                      <input name="date_time_to" type="text" class="form-control">
                  </div>

              </div>            
          </div> 

      </form>
      </div>
      <div class="modal-footer">
        <button id="action-post" type="button" class="btn btn-primary">Post</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>