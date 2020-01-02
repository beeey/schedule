<?php

namespace Tests\Feature;

use App\Schedule;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Schedule
     */
    protected $schedule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->schedule = tap(factory(Schedule::class)->create(), function (Schedule $schedule) {
            $schedule->users()->attach($this->user);
        });
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex(): void
    {
        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)->put("api/schedules/{$this->schedule->id}", [
            'starts_at' => '2020-01-01 00:01:00',
            'ends_at' => '2020-01-02 00:05:00',
            'title' => 'test',
            'content' => 'content'
        ], [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);
        $response
            ->assertJson([
                'data' => [
                    'starts_at' => '2020-01-01 00:01:00',
                    'ends_at' => '2020-01-02 00:05:00',
                    'title' => 'test',
                    'content' => 'content'
                ],
            ])
            ->assertStatus(200);
    }
}
