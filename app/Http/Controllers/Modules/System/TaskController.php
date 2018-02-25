<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Task\SaveTaskRequest;
use App\Modules\System\Group\Group;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Post\Post;
use App\Modules\System\Task\Repository\TaskRepository;
use App\Modules\System\Task\StudentTaskCompletion;
use App\Modules\System\Task\Task;
use App\Modules\System\Task\TaskItem;
use App\Modules\System\User\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as RequestFacade;
use function handle_controller_exception;
use function redirect;
use function response;
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

    public function taskGroupResults($taskId, $groupCode)
    {
        $task  = Task::findOrFail($taskId);
        $group = Group::findOrFail($groupCode);

        $taskCompletion = StudentTaskCompletion::taskId($taskId)->get();
        $taskPointMap   = [];

        foreach ( $taskCompletion as $completedTask ) {
            $taskPointMap[$completedTask->student_number] = $completedTask->points;
        }

        $results = [];
        foreach ( $group->studentMembers as $student ) {
            array_push($results, [
                'student_number'       => $student->student_number,
                'student_display_name' => $student->display_name,
                'total_points'         => array_key_exists($student->student_number, $taskPointMap) ? $taskPointMap[$student->student_number] : 'x',
            ]);
        }

        return view('pages.task.group-report', [
            'group'   => $group,
            'task'    => $task,
            'results' => $results
        ]);
    }

    public function studentResponses($taskId, $groupCode, $studentNumber)
    {
        $task  = Task::with('items')->findOrFail($taskId);
        $group = Group::with('studentMembers')->findOrFail($groupCode);

        $student          = Student::with('userAccount')->findOrFail($studentNumber);
        $taskCompletion   = StudentTaskCompletion::taskId($taskId)->studentNumber($studentNumber)->first();
        $studentResponses = DB::table('student_response')
            ->where('student_number', $studentNumber)
            ->where('task_id', $taskId)
            ->get();

        $responseMap = [];
        foreach ( $studentResponses as $response ) {
            $responseMap[$response->task_item_order] = $response;
        }

        return view('pages.task.student-task-report', [
            'group'          => $group,
            'task'           => $task,
            'student'        => $student,
            'taskCompletion' => $taskCompletion,
            'responses'      => $responseMap
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::where('module', 'Task')
                ->with('group')
                ->with(['task' => function($query) {
                        $query->withStudentNumberOfUser(Auth::user());
                    }])->get();

//        $tasks = Task::with('post')->withStudentNumberOfUser(Auth::user())->get();
        return view('pages.task.index', ['posts' => $posts]);
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
        if ( Auth::user()->student ) {
            $task    = Task::withStudentNumberOfUser(Auth::user())->find($id);
            $student = Auth::user()->student()->first();

            return view('pages.task.view', [
                'task'    => $task,
                'student' => $student,
            ]);
        } else {
            $task = Task::with('groups_posted')->find($id);

            return view('pages.task.report', [
                'task' => $task
            ]);
        }
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
        $answers = $request->except(['_token', 'token']);         
        
        try {
            $this->saveAnswers($answers, $taskId);
        } catch ( Exception $ex ) {
            if ( $request->ajax() ) {
                return response($ex->getMessage(), 500);
            } else {
                throw $ex;
            }
        }
        
        if ( $request->wantsJson() ) {            
            return response()->json(['message' => 'success']);
        } else {
            $request->session()->flash('message', "You've successfully submitted your answers. Please wait for your teacher/instructor to publish the task results.");
            return redirect('task');
        }
    }

    //  move this to a service later as there's a duplicate in API task controller
    private function saveAnswers($answers, $taskId)
    {
        return DB::transaction(function() use ($answers, $taskId) {

                $student = Auth::user()->student()->first();

                DB::table('student_response')
                    ->whereTaskId($taskId)
                    ->whereStudentNumber($student->student_number)
                    ->delete();

                DB::table('student_task_completed')
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
    }

    public function generateTaskReport($taskId, $groupCode)
    {
        $task  = Task::find($taskId);
        $group = Group::find($groupCode);
        return view('pages.task.group-report', [
            'task'  => $task,
            'group' => $group
        ]);
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
