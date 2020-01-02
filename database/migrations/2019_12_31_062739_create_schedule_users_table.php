<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules');
            $table->boolean('is_author')->default('0');
            $table->boolean('authority')->storedAs('case when is_author then 1 else null end')->nullable();
            $table->unique(['user_id', 'schedule_id']);
            $table->unique(['schedule_id', 'authority']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_users');
    }
}
