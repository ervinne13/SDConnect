<?php

namespace App\Modules\System\Task;

use App\Modules\System\Task\TaskItem;
use Illuminate\Database\Eloquent\Model;

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
}
