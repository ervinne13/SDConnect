
<div class="class-task-item">

    <div class="form-group">
        <label class="control-label" for="input-type">Task Type</label>
            <select name="type-code" id="input-type" required class="form-control select2-input">
                @foreach($taskTypes AS $code => $name)
                    <?php $selected = $code == $task->getTypeCode() ? "selected" : "" ?>
                    <option {{$selected}} value="{{$code}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>