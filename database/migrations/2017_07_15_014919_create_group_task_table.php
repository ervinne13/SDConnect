<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTaskTable extends Migration
{

    const TABLE_NAME = 'group_task';

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
            $table->string('group_code', 30);
            $table->bigInteger('task_id')->unsigned();

            $table->primary([ 'group_code', 'task_id' ]);
            $table->foreign('group_code')
                    ->references('code')->on('group')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('task_id')
                    ->references('id')->on('task')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->index('group_code');
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

        Schema::drop(self::TABLE_NAME);
    }

}
