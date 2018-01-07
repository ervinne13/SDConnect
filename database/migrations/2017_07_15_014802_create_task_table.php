<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{

    const TABLE_NAME = 'task';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('randomizes_tasks')->default(false);
            $table->integer('time_limit_minutes')->unsigned()->default(0);
            $table->string('display_name', 30)->unique();
//            $table->dateTime('deadline');
            $table->string('description');
            $table->string('type_code', 3)->comment('(A)ssignment, (Q)uiz, (E)xam');
            $table->timestamps();
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
