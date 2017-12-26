<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskItemTable extends Migration
{

    const TABLE_NAME = 'task_item';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigInteger('task_id')->unsigned();
            $table->integer('order')->unsigned();
            $table->string('type_code')
                ->comment('Type Code: (MC) Multiple Choice, (TF) True or False, (FB) Fill in the Blanks, (ATT) Attachment, (E) Essay');
            $table->integer('points')->unsigned();
            $table->string('task_item_name', 30);
            $table->text('task_item_text');
            $table->text('choices_json');
            $table->text('correct_answer_free_field');
            $table->timestamps();
            
            $table->primary(['task_id', 'order']);
//
            $table->foreign('task_id')
                ->references('id')
                ->on('task')
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists(self::TABLE_NAME);

        Schema::disableForeignKeyConstraints();
    }

}
