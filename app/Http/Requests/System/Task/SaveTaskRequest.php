<?php

namespace App\Http\Requests\System\Task;

use App\Modules\System\Task\Task;
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
            'randomizes_tasks' => 'requred',
            'type_code'        => 'requred',
            'display_name'     => 'requred',
            //  TODO: other rules
        ];
    }

    public function decompose()
    {
        $this->task = new Task($this->request->toArray());
        $this->task->save();
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
