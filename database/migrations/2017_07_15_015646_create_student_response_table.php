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
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if ( Schema::hasTable(self::TABLE_NAME) ) {
            return;
        }
        // </editor-fold>

        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->string('student_number', 30);
            $table->bigInteger('task_item_id')->unsigned();
            $table->integer('points')->unsigned();
            $table->text('answer_free_field');
            $table->timestamps();

            $table->foreign('task_item_id')
                ->references('id')->on('task_item');
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

        Schema::drop(self::TABLE_NAME);
    }

}
