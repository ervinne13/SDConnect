<?php

namespace App\Modules\System\Task;

use App\Modules\System\Group\Group;
use App\Modules\System\Post\Post;
use App\Modules\System\Task\TaskItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

class Task extends Model
{

    const TYPES = [
        'A' => 'Assignment',
        'Q' => 'Quiz',
        'E' => 'Exam',
    ];

    protected $table    = 'task';
    protected $fillable = [
        'display_name',
        'type_code',
        'randomizes_tasks',
        'time_limit_minutes',
        'description'
    ];

    // <editor-fold defaultstate="collapsed" desc="Relationships">

    public function items()
    {
        return $this->hasMany(TaskItem::class, 'task_id');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'related_data_id')->where('post.module', 'Task');
    }

    public function groups_posted()
    {
        return $this->belongsToMany(Group::class, 'group_task', 'task_id', 'group_code');
    }

    // </editor-fold>

    /**/
    // <editor-fold defaultstate="collapsed" desc="Encapsulation">

    public function getDisplayName()
    {
        return $this->display_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTypeCode()
    {
        return $this->type_code;
    }

    public function randomizesTaskItems()
    {
        return $this->randomizes_task_items;
    }

    // </editor-fold>

    public function scopeUserGroups($query, $groupCodeList)
    {
        return $query
                ->select('task.*')
                ->join('post', 'post.related_data_id', '=', 'task.id')
                ->whereIn('post.group_code', $groupCodeList)
        ;
    }

    public function scopeWithStudentNumberOfUser($query, User $user)
    {
        return $query
                ->select('task.*', 'student_task_completed.student_number')
                ->distinct('student_task_completed.task_id')
                ->leftJoin('student_task_completed', function($join) use ($user) {

                    if ( $user->student ) {
                        $join->on('student_task_completed.task_id', '=', 'task.id');
                        $join->on('student_task_completed.student_number', '=', DB::raw("'{$user->student->student_number}'"));
                    } else {
                        $join->on('student_task_completed.task_id', '=', 'task.id')->whereNull('student_task_completed.student_number');
                    }
                });
    }

    public function scopeWithoutResponse($query, User $user)
    {
        return $query
                ->select('task.*', 'student_task_completed.student_number')
                ->distinct('student_task_completed.task_id')
                ->join('student_task_completed', function($join) use ($user) {
                    $join->on('student_task_completed.task_id', '=', 'task.id');
                    $join->on('student_task_completed.student_number', '=', DB::raw("'{$user->student->student_number}'"));
                });
//                ->where('student_task_completed.student_number', '!=', $user->student->student_number);   //  outer join
//                ->where('student_task_completed.student_number', $user->student->student_number);
    }

}
