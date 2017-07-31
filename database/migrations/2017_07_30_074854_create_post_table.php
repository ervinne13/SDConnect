<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{

    const TABLE_NAME = 'post';

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
            $table->string('author_username', 30)->index();
            $table->string('group_code', 30)->index();
            $table->boolean('include_in_calendar')->default(false);
            $table->string('module');
            $table->string('calendar_color')->nullable();
            $table->string('relative_url')->nullable();
            $table->dateTime('date_time_from');
            $table->dateTime('date_time_to');
            $table->text('content');

            $table->timestamps();

            $table->foreign('author_username')
                ->references('username')->on('user_account')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('group_code')
                ->references('code')->on('group')
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
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if ( !Schema::hasTable(self::TABLE_NAME) ) {
            return;
        }
        // </editor-fold>

        Schema::drop(self::TABLE_NAME);
    }

}
