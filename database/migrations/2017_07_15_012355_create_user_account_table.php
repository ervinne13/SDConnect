<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountTable extends Migration
{

    const TABLE_NAME = 'user_account';

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
            $table->string('username', 30);
            $table->string('display_name', 100);
            $table->string('password', 120);
            $table->string('image_url', 255)->nullable();
            $table->rememberToken();

            $table->primary('username');
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
