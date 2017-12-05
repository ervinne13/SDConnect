
<script id="task-item-view-template" type="text/html">

    <div class="task-item-container" data-id="<%= id %>">

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label class="control-label" for="input-type">Task Type</label>
                    <select name="type_code" id="input-type" required class="form-control select2-input">
                        <% for (let code in TaskItemEditorView.TaskItemTypes) { %>
                        <% let selected = type_code === code ? 'selected' : ''; %>
                        <option value="<%= code %>" <%= selected %>><%= TaskItemEditorView.TaskItemTypes[code] %></option>
                        <% } %>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="input-points">Points</label>
                    <input name="points" type="number" id="input-points" class="form-control" value="<%= points %>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="input-task-item-text">Question / Instructions</label>
            <textarea name="task_item_text" id="input-task-item-text" class="form-control"><%= task_item_text %></textarea>
        </div>        

        <div id="special-fields-container">

        </div>

        <div class="action-buttons">
            <div class="pull-left">
                <button id="action-save-task-item" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Save Task Item
                </button>
                <button id="action-save-new-task-item" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    Save Task Item And New
                </button>
            </div>
            <div class="pull-right">
                <button id="action-delete-task-item" class="btn btn-danger">
                    <i class="fa fa-remove"></i>
                    Delete Task Item
                </button>
            </div>
        </div>

    </div>
</script>

<script id="multiple-choice-option-template" type="text/html">
    <li class="mc-option list-group-item">
        <div class="input-group m-b-1">
            <span class="input-group-addon">
                <a href="javascript:void(0)" class="action-remove-mc-option">
                    <i class="fa fa-remove"></i>
                </a>
            </span>
            <span class="input-group-addon">
                <input type="radio" name="correct_answer_free_field" class="check-correct-answer" value="<%= option_text %>">
            </span>
            <input type="text" class="form-control mc-option-text" placeholder="Enter a text for the option" value="<%= option_text %>">
        </div>                        
    </li>
</script>

<script id="multiple-choice-task-special-fields-template" type="text/html">
    <div class="options">
        <div class="form-group">
            <span>
                <label class="control-label" for="input-options">Options (Select the correct answer):</label>
                <button id="action-add-option" class="btn btn-sm btn-medium pull-right">
                    <i class="fa fa-plus"></i>
                    Add Option
                </button>
            </span>

            <ul id="choices-container" class="list-group shadow-box m-t-2">

            </ul>
        </div>     
    </div>
</script>

<script id="true-or-false-task-special-fields-template" type="text/html">
    <div class="options">
        <div class="form-group">
            <label class="control-label" for="input-answer">Answer:</label>
            <select name="correct_answer_free_field" id="input-answer" required class="form-control select2-input">
                <option value="true">True</option>
                <option value="false">False</option>
            </select>
        </div>
    </div>
</script>

