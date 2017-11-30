<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration {

    const TABLE_NAME = 'schedule';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('teacher_username', 30);
            $table->string('period', 30);
            $table->string('subject', 30);
            $table->string('duration', 30);
            $table->string('location', 30);
            $table->timestamps();

            $table->foreign('teacher_username')
                    ->references('user_account_username')->on('teacher')
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
        Schema::dropIfExists(self::TABLE_NAME);
    }

}
