<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Task\SaveTaskRequest;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Task\Repository\TaskRepository;
use App\Modules\System\Task\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function view;

class TaskController extends Controller
{

    /** @var GroupRepository */
    protected $groupRepo;

    /** @var TaskRepository */
    protected $taskRepo;

    public function __construct(TaskRepository $taskRepo, GroupRepository $groupRepo)
    {
        $this->taskRepo  = $taskRepo;
        $this->groupRepo = $groupRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $group = $request->group ? $this->groupRepo->find($request->group) : null;
        $task  = new Task();

        return view('pages.task.form', [
            "group"     => $group,
            "task"      => $task,
            "taskTypes" => Task::TYPES,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveTaskRequest  $request
     * @return Response
     */
    public function store(SaveTaskRequest $request, TaskRepository $repo)
    {
        try {
            $savedTask = $repo->saveWithHttpRequest($request);
            return $savedTask;
        } catch(Exception $e) {
            return handle_controller_exception($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
