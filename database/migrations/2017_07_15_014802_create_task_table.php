<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration {

    const TABLE_NAME = 'task';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if (Schema::hasTable(self::TABLE_NAME)) {
            return;
        }
        // </editor-fold>

        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('display_name', 30)->unique();
            $table->string('type_code', 3)->comment('(A)ssignment, (Q)uiz, (E)xam');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        // <editor-fold defaultstate="collapsed" desc="Pessimistic Validation">
        if (!Schema::hasTable(self::TABLE_NAME)) {
            return;
        }
        // </editor-fold>

        Schema::drop(self::TABLE_NAME);
    }

}
