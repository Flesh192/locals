<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dateTime('created_at')->default(null)->change();
            $table->dateTime('updated_at')->default(null)->change();
        });

        Schema::table('post', function (Blueprint $table) {
            $table->dateTime('created_at')->default(null)->change();
            $table->dateTime('updated_at')->default(null)->change();
        });

        Schema::table('user_mute', function (Blueprint $table) {
            $table->dateTime('expired_at')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->integer('created_at')->change();
            $table->integer('updated_at')->change();
        });

        Schema::table('post', function (Blueprint $table) {
            $table->integer('created_at')->change();
            $table->integer('updated_at')->change();
        });

        Schema::table('user_mute', function (Blueprint $table) {
            $table->integer('expired_at')->change();
        });
    }
}
