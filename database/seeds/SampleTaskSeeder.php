<?php

use App\Modules\System\Post\Post;
use App\Modules\System\Task\Task;
use App\Modules\System\Task\TaskItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleTaskSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            $task = new Task();

            $task->randomizes_tasks   = 1;
            $task->time_limit_minutes = 30;
            $task->display_name       = 'Exam 001 (Demo)';
            $task->description        = 'This is a test exam with 30 mins time limit';
//            $task->deadline           = '2018-01-10';

            $task->type_code = 'E';

            $task->save();

            $questions = [
                ['MC', 1, 'The speedometer is an example of what kind of computer?', ['Hybrid', 'Digital', 'Analog', 'None of the Above'], 'Analog'],
                ['MC', 1, 'Every number system has a base, which is called what?', ['Index', 'Subscript', 'Radix', 'None of the Above'], 'Radix'],
                ['TF', 1, '1MB is equal to 1,000 bytes', null, false],
                ['TF', 1, 'A language must be turing complete to be considered a programming language', null, true]
            ];

            $order = 1;
            foreach ( $questions as $question ) {
                $taskItem                            = new TaskItem();
                $taskItem->task_id                   = $task->id;
                $taskItem->order                     = $order;
                $taskItem->type_code                 = $question[0];
                $taskItem->points                    = $question[1];
                $taskItem->task_item_text            = $question[2];
                $taskItem->choices_json              = json_encode($question[3]);
                $taskItem->correct_answer_free_field = $question[4];

                $taskItem->save();

                $order ++;
            }

            //  create post for the task
            $post                      = new Post();
            $post->author_username     = 'admin';
            $post->group_code          = 'IT-2017';
            $post->include_in_calendar = true;
            $post->module              = 'Task';
            $post->calendar_color      = '#edf0f5';
            $post->relative_url        = 'http://sdconnect.local/task/' . $task->id;
            $post->related_data_id     = $task->id;
            $post->date_time_from      = '2017-12-20';
            $post->date_time_to        = '2018-01-10';
            $post->content             = 'Exam for first quarter, please submit on or before the due date';
            $post->save();
        });
    }

}
