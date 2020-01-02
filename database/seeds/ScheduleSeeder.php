<?php

use App\Schedule;
use App\User;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        factory(Schedule::class, 100)->create()->each(function (Schedule $schedule) use ($users) {
            $schedule->users()->attach($users->random(mt_rand(0, 5)));
        });
    }
}
