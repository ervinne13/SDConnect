<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration
{

    const TABLE_NAME = 'group';

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
            $table->string('code', 30)->index();
            $table->string('owner_username', 30)->index();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_system_generated')->default(false);
            $table->string('color', 30);
            $table->string('type', 30);
            $table->string('display_name', 100)->index();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->primary('code');
            $table->foreign('owner_username')
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
        //  disable constraints, group member table is dependent on this
        Schema::disableForeignKeyConstraints();

        Schema::drop(self::TABLE_NAME);

        Schema::disableForeignKeyConstraints();
    }

}
