<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentResponseTable extends Migration
{

    const TABLE_NAME = 'student_response';

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
            $table->integer('task_item_order')->unsigned();
            $table->integer('points')->unsigned();
            $table->text('answer_free_field');
            $table->timestamps();

//            $table->foreign('task_id')
//                ->references('task_id')
//                ->on('task_item');
//
//            $table->foreign('task_item_order')
//                ->references('order')
//                ->on('task_item');
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
