<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTaskCompletedTable extends Migration
{

    const TABLE_NAME = 'student_task_completed';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->string('student_number', 30);
            $table->bigInteger('task_id')->unsigned();
            $table->integer('points')->default(0);

            $table->foreign('student_number')
                ->references('student_number')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('task_id')
                ->references('task_id')
                ->on('task_item')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }

}
