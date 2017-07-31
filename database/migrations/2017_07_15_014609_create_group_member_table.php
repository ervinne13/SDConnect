<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMemberTable extends Migration
{

    const TABLE_NAME = 'group_member';

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
            $table->string('group_code', 30);

            $table->primary(['user_account_username', 'group_code']);
            $table->foreign('group_code')
                ->references('code')
                ->on('group')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_account_username')
                ->references('username')
                ->on('user_account')
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
