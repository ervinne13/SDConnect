<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{

    const TABLE_NAME = 'material';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->increments('id');
            $table->string('owner_username', 30);
            $table->string('display_name', 100)->index();
            $table->string('privacy', 30);
            $table->string('file_type', 100);
            $table->string('file_relative_url', 200);

            $table->timestamps();

            $table->foreign('owner_username')
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
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
