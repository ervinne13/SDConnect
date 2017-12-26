<form id="group-form" class="fields-container">

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" for="input-type">Task Type</label>
                <select name="type_code" id="input-type" required class="form-control select2-input">
                    @foreach($taskTypes AS $code => $name)
                    <?php $selected = $code == $task->getTypeCode() ? "selected" : "" ?>
                    <option {{$selected}} value="{{$code}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="input-display-name">Task Display Name</label>
                <input name="display_name" id="input-display-name" type="text" value="{{$task->getDisplayName()}}" class="form-control">
            </div>

            <div class="form-group">
                <label class="control-label" for="input-display-name">About this task</label>
                <input name="description" id="input-display-name" type="text" value="{{$task->getDescription()}}" class="form-control">
            </div>

            <div class="form-group">
                <label class="control-label" for="input-display-name">Randomizes Task Items</label>
                <input id="randomizes-task-items" name="randomizes_tasks" type="checkbox" class="js-switch" {{$task->randomizesTaskItems() ? "checked" : ""}}>
            </div>

        </div>            
    </div> 

</form>