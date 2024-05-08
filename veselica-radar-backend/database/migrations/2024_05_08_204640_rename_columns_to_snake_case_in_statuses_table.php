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
        Schema::table('statuses', function (Blueprint $table) {
            $table->renameColumn('userId', 'user_id');
            $table->renameColumn('eventId', 'event_id');
            $table->renameColumn('status', 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->renameColumn('user_id', 'userId');
            $table->renameColumn('event_id', 'eventId');
            $table->renameColumn('status', 'status');
        });
    }
};
