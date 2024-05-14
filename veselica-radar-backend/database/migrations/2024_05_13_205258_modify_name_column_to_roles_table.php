<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('roles', 'name')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }

        Schema::table('roles', function (Blueprint $table) {
            $table->enum('name', ['user', 'admin', 'waiter'])->after('id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
