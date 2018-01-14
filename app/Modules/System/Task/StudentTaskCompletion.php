<?php

namespace App\Modules\System\Task;

use Illuminate\Database\Eloquent\Model;

class StudentTaskCompletion extends Model
{

    public $incrementing = false;
    public $timestamps   = false;
    protected $table     = 'student_task_completed';

}
