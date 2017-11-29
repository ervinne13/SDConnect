
<script id="task-item-view-template" type="text/html">

    <div class="task-item-container" data-id="<%= id %>">

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label class="control-label" for="input-type">Task Type</label>
                    <select name="type_code" id="input-type" required class="form-control select2-input">
                        <% for (let code in TaskItemListView.TaskItemTypes) { %>
                        <% let selected = type_code === code ? 'selected' : ''; %>
                        <option value="<%= code %>" <%= selected %>><%= TaskItemListView.TaskItemTypes[code] %></option>
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

        <div class="options" data-option-code="MC">
            <div class="form-group">
                <span>
                    <label class="control-label" for="input-options">Options (Select the correct answer):</label>
                    <button id="action-add-option" class="btn btn-sm btn-primary pull-right">
                        <i class="fa fa-plus"></i>
                        Add Option
                    </button>
                </span>

                <ul id="choices-container" class="list-group shadow-box m-t-2">

                </ul>
            </div>     
        </div>

        <div class="options" data-option-code="TF">
            <div class="form-group">
                <label class="control-label" for="input-answer">Answer:</label>
                <select name="correct_answer_free_field" id="input-answer" required class="form-control select2-input">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
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
                <input type="radio" name="correct_answer_free_field" class="check-correct-answer" value="test">
            </span>
            <input type="text" class="form-control" placeholder="Enter a text for the option">
        </div>                        
    </li>
</script>