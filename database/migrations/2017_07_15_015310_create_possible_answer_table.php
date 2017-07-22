<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossibleAnswerTable extends Migration {

    const TABLE_NAME = 'question_possible_answer';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if (Schema::hasTable(self::TABLE_NAME)) {
            return;
        }
        // </editor-fold>

        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('question_id');
            $table->string('answer_text', 120);
            $table->timestamps();

            $table->foreign('question_id')
                    ->references('id')->on('question')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if (!Schema::hasTable(self::TABLE_NAME)) {
            return;
        }
        // </editor-fold>

        Schema::drop(self::TABLE_NAME);
    }

}
