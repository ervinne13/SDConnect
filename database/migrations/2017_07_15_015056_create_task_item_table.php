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
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if ( Schema::hasTable(self::TABLE_NAME) ) {
            return;
        }
        // </editor-fold>

        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('task_id')->unsigned();
            $table->string('type_code')
                ->comment('Type Code: (MC) Multiple Choice, (TF) True or False, (FB) Fill in the Blanks, (ATT) Attachment, (E) Essay');
            $table->integer('points')->unsigned();
            $table->text('task_item_text');
            $table->text('choices_json');
            $table->text('correct_answer_free_field');
            $table->timestamps();

            $table->foreign('task_id')
                ->references('id')->on('task')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index('task_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if ( !Schema::hasTable(self::TABLE_NAME) ) {
            return;
        }
        // </editor-fold>

        Schema::disableForeignKeyConstraints();

        Schema::drop(self::TABLE_NAME);

        Schema::disableForeignKeyConstraints();
    }

}
