<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Schedule;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * ScheduleController constructor.
     * @param ResponseFactory $responseFactory
     *
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->response = $responseFactory;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * スケジュール一覧取得
     */
    public function index(Request $request) :AnonymousResourceCollection
    {
        return ScheduleResource::collection(Schedule::all());
    }

    /**
     * @param Request $request
     * @return ScheduleResource
     *
     * スケジュール作成
     */
    public function store(Request $request) :ScheduleResource
    {
        $schedule = new Schedule();
        $schedule->forceFill($request->only('starts_at', 'ends_at', 'title', 'content'));
        $schedule->save();
        $schedule->users()->attach(Auth::user());
        return new ScheduleResource($schedule);
    }

    /**
     * @param Schedule $schedule
     * @param Request $request
     * @return ScheduleResource
     *
     * スケジュール更新
     */
    public function update(Schedule $schedule, Request $request) :ScheduleResource
    {
        $schedule->forceFill($request->only('starts_at', 'ends_at', 'title', 'content'));
        $schedule->save();
        $schedule->users()->attach(Auth::user());
        return new ScheduleResource($schedule);
    }

    /**
     * @param Schedule $schedule
     * @return ScheduleResource
     * @throws \Exception
     *
     * スケジュール削除
     */
    public function delete(Schedule $schedule) :ScheduleResource
    {
        $schedule->delete();
        return new ScheduleResource($schedule);
    }
}
