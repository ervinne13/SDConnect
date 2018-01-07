<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Task\SaveTaskRequest;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Task\Repository\TaskRepository;
use App\Modules\System\Task\Task;
use App\Modules\System\Task\TaskItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function handle_controller_exception;
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

    public function listAllJson()
    {
        return Task::all();
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
        } catch ( Exception $e ) {
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
        $task    = Task::find($id);
        $student = Auth::user()->student()->first();

        return view('pages.task.view', [
            'task'    => $task,
            'student' => $student,
        ]);
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
     * TODO: refactor - this will be redone in CI anyway so don't bother with models
     * and repositories anymore
     * @param Request $request
     * @param type $taskId
     * @return type
     */
    public function submitAnswers(Request $request, $taskId)
    {
        $answers = $request->except('_token');

        DB::transaction(function() use ($answers, $taskId) {

            $student = Auth::user()->student()->first();

            DB::table('student_response')
                ->whereTaskId($taskId)
                ->whereStudentNumber($student->student_number)
                ->delete();

            $totalPoints = 0;

            foreach ( $answers as $key => $studentAnswer ) {
                $order    = str_replace('task_item_', '', $key);
                $taskItem = TaskItem::findComposite($taskId, $order);

                if ( !$taskItem ) {
                    throw new Exception('Task item order ' . $order . ' not found');
                }

                $points = $this->getTaskItemPoints($taskItem, $studentAnswer);

                DB::table('student_response')->insert([
                    'student_number'    => $student->student_number,
                    'task_id'           => $taskId,
                    'task_item_order'   => $order,
                    'points'            => $points,
                    'answer_free_field' => $studentAnswer
                ]);

                $totalPoints += $points;
            }

            DB::table('student_task_completed')->insert([
                'student_number' => $student->student_number,
                'task_id'        => $taskId,
                'points'         => $totalPoints,
            ]);
        });

        $request->session()->flash('message', "You've successfully submitted your answers. Please wait for your teacher/instructor to publish the task results.");
        return redirect('task');
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

    private function getTaskItemPoints(TaskItem $taskItem, $studentAnswer)
    {
        $correctAnswer = trim($taskItem->correct_answer_free_field);

        if ( $taskItem->type_code != 'MC' ) {
            $points = $correctAnswer == trim($studentAnswer) ? $taskItem->points : 0;
        }

        switch ( $taskItem->type_code ) {
            case 'MC':
                $points       = $correctAnswer == trim($studentAnswer) ? $taskItem->points : 0;
                break;
            case 'TF':
                $correctTrue  = $correctAnswer == 1 && trim($studentAnswer) == 'true';
                $correctFalse = $correctAnswer == 0 && trim($studentAnswer) == 'false';
                if ( $correctTrue || $correctFalse ) {
                    $points = $taskItem->points;
                } else {
                    $points = 0;
                }
                break;
        }

        return $points;
    }

}
