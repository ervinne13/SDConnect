<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration {

    const TABLE_NAME = 'teacher';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->string('user_account_username', 30);
            $table->boolean('is_active')->default(true);
            $table->text('about');
            $table->timestamps();

            $table->primary('user_account_username');
            $table->foreign('user_account_username')
                    ->references('username')->on('user_account')
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
