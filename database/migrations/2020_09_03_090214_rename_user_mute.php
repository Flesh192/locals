<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserMute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_mute', function (Blueprint $table) {
            $table->renameColumn('mute_id', 'mute_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_mute', function (Blueprint $table) {
            $table->renameColumn('mute_user_id', 'mute_id');
        });
    }
}
