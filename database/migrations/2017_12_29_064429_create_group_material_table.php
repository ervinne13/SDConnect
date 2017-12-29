<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMaterialTable extends Migration
{
    const TABLE_NAME = 'group_material';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function(Blueprint $table) {
            $table->string('group_code', 30);
            $table->integer('material_id')->unsigned();

            $table->primary(['group_code', 'material_id']);

            $table->foreign('group_code')
                ->references('code')->on('group')
                ->onDelete('cascade')
                ->onUpdate('cascade'); 

            $table->foreign('material_id')
                ->references('id')->on('material')
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
