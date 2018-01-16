<?php

namespace App\Http\Controllers\Modules\API;

use App\Http\Controllers\Controller;
use App\Modules\System\Task\Task;

class TaskController extends Controller
{

    public function listAll()
    {
        return Task::all();
    }

}
