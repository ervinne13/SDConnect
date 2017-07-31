<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountRoleTable extends Migration
{

    const TABLE_NAME = 'user_account_role';

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
            $table->string('user_account_username', 30);
            $table->string('role_code', 30);
            $table->timestamps();

            $table->primary([ 'user_account_username', 'role_code' ]);
            $table->foreign('user_account_username')
                    ->references('username')->on('user_account')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('role_code')
                    ->references('code')->on('role')
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
