<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('帳號ID');
            $table->bigInteger('pet_id')->unsigned()->comment('動物ID');
            $table->timestamps();
        });

        Schema::table('wishlist', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });

        Schema::table('wishlist', function (Blueprint $table) {
            $table->foreign('pet_id')
            ->references('id')->on('pets')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlist', function (Blueprint $table) {
            $table->dropForeign('wishlist_user_id_foreign');
            $table->dropForeign('wishlist_pet_id_foreign');
        });
        Schema::dropIfExists('wishlist');
    }
}
