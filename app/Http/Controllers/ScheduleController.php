<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Schedule;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->response = $responseFactory;
    }

    public function index(Request $request)
    {
        return ScheduleResource::collection(Schedule::all());
    }

    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->forceFill($request->only('starts_at', 'ends_at', 'title', 'content'));
        $schedule->save();
        $schedule->users()->attach(Auth::user());
        return new ScheduleResource($schedule);
    }

    public function update(Schedule $schedule, Request $request)
    {
        $schedule->forceFill($request->only('starts_at', 'ends_at', 'title', 'content'));
        $schedule->save();
        $schedule->users()->attach(Auth::user());
        return new ScheduleResource($schedule);
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();
        return new ScheduleResource($schedule);
    }
}
