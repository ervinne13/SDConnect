<?php

namespace App\Http\Requests\System\Task;

use App\Modules\System\Task\Task;
use App\Modules\System\Task\TaskItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveTaskRequest extends FormRequest
{

    protected $task;
    protected $taskItems;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //  TODO: add other authorization
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'randomizes_tasks' => 'required',
            'type_code'        => 'required',
            'display_name'     => 'required',
            //  TODO: other rules
        ];
    }

    public function decompose()
    {
        //  decompose the task 
        $this->task = new Task($this->toArray());
        $this->task->time_limit_minutes = 0;    //  default
        
        //  decompose task item list
        $this->taskItems = [];
        foreach ($this->task_items as $taskItem) {
            if (!$taskItem) {
                continue;
            }
            
            $taskItem = new TaskItem($taskItem);
            $taskItem->choices_json = json_encode($taskItem['choices_json']);
            array_push($this->taskItems, $taskItem);
        }
    }

    public function getTask()
    {
        return $this->task;
    }

    public function getTaskItems()
    {
        return $this->taskItems;
    }

}
