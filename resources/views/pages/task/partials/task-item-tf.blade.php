<div>
    <p>{{$orderDisplay}}. {{$taskItem->task_item_text}} ({{$taskItem->points}} Point(s))</p>
    
    <div class="radio">
        <label>
            <input type="radio" name="task_item_{{$taskItem->order}}" id="task_item_{{$taskItem->order}}" value="true">
            True
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="task_item_{{$taskItem->order}}" id="task_item_{{$taskItem->order}}" value="false">
            False
        </label>
    </div>
</div>