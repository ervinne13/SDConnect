<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskItemChoiceTable extends Migration
{

    const TABLE_NAME = 'task_item_choice';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('task_id')->unsigned();
            $table->integer('task_item_order')->unsigned();
            $table->string('answer_text', 120);
            $table->timestamps();

//            $table->foreign('task_id')
//                ->references('task_id')
//                ->on('task_item');

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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists(self::TABLE_NAME);

        Schema::disableForeignKeyConstraints();
    }

}
