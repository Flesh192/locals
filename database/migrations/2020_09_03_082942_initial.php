<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec(file_get_contents(__DIR__.'/scheme.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //no down migration for initial setup
    }
}
