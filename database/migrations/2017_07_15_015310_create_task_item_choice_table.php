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
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if ( Schema::hasTable(self::TABLE_NAME) ) {
            return;
        }
        // </editor-fold>

        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('task_item_id')->unsigned();
            $table->string('answer_text', 120);
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

        Schema::disableForeignKeyConstraints();

        Schema::drop(self::TABLE_NAME);

        Schema::disableForeignKeyConstraints();
    }

}
