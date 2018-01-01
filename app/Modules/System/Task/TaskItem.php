<?php

namespace App\Modules\System\Task;

use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{

    const TYPES = [
        'MC'  => 'Multiple Choice',
        'TF'  => 'True or False',
        'FB'  => 'Fill in the Blanks',
        'ATT' => 'Attachment',
        'E'   => 'Essay',
    ];

    protected $table    = 'task_item';
    protected $fillable = ['task_id', 'type_code', 'order', 'points', 'task_item_text', 'choices_json', 'correct_answer_free_field'];

    public function scopeTask($query, $id)
    {
        return $query->where('task_id', $id);
    }

}
