<div>
    <p>{{$order}}. {{$taskItem->task_item_text}} ({{$taskItem->points}} Point(s))</p>

    @php
    $choices = json_decode($taskItem->choices_json);
    @endphp

    @foreach($choices as $choice)
    <div class="radio">
        <label>
            <input type="radio" name="task_item_{{$taskItem->order}}" id="task_item_{{$taskItem->order}}" value="{{$choice}}">
            {{$choice}}
        </label>
    </div>
    @endforeach
</div>