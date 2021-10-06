<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('age')->comment('年紀');
            $table->tinyInteger('gender')->comment('性別');
            $table->boolean('fix')->default(false)->comment('是否結紮');
            $table->string('description')->comment('描述');
            $table->string('area')->comment('地區');
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
        Schema::dropIfExists('pets');
    }
}
