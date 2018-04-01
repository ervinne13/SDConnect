<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountBadgeJunctionTable extends Migration
{

    const TABLE_NAME = 'user_account_badge';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->string('user_account_username', 30);
            $table->integer('badge_id')->unsigned();

            $table->foreign('user_account_username')
                ->references('username')
                ->on('user_account')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('badge_id')
                ->references('id')
                ->on('badge')
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
        Schema::dropIfExists(self::TABLE_NAME);
    }

}
