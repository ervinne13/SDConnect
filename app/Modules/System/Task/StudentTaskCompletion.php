<?php

namespace App\Modules\System\Task;

use Illuminate\Database\Eloquent\Model;

class StudentTaskCompletion extends Model
{

    public $incrementing = false;
    public $timestamps   = false;
    protected $table     = 'student_task_completed';

    public function scopeTaskId($query, $taskId)
    {
        return $query->where('task_id', $taskId);
    }

    public function scopeStudentNumber($query, $studentNumber)
    {
        return $query->where('student_number', $studentNumber);
    }

}
