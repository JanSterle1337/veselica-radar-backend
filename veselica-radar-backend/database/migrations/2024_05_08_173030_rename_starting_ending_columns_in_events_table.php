<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('startingHour', 'starting_hour');
            $table->renameColumn('endingHour', 'ending_hour');
            $table->renameColumn('isEntranceFee', 'is_entrance_fee');
            $table->renameColumn('entranceFee', 'entrance_fee');
            $table->renameColumn('eventDate', 'event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('starting_hour', 'startingHour');
            $table->renameColumn('ending_hour', 'endingHour');
            $table->renameColumn('is_entrance_fee', 'isEntranceFee');
            $table->renameColumn('entrance_fee', 'entranceFee');
            $table->renameColumn('event_date', 'eventDate');
        });
    }
};
