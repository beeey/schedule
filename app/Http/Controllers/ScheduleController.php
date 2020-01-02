<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Schedule;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function indexOfAuthored(Request $request)
    {
        return ScheduleResource::collection(Auth::user()->authoredSchedules);
    }

    public function indexOfAttending(Request $request)
    {
        return ScheduleResource::collection(Auth::user()->attendingSchedules);
    }

    /**
     * @param Request $request
     * @return ScheduleResource
     *
     * スケジュール作成
     */
    public function store(Request $request) :ScheduleResource
    {
        $validator = Validator::make($request->only('starts_at', 'ends_at', 'title', 'content'),
            [
                'starts_at' => [
                    'required',
                    'date_format:Y-m-d',
                    'date_format:H:i'
                ],
                'ends_at' => [
                    'required',
                    'date_format:Y-m-d',
                    'date_format:H:i'
                ],
                'title' => [
                    'required',
                    'max:30'
                ],
                'content' => [
                    'max:200'
                ]
            ]
        );

        $validator->validate();

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
        Log::debug(['test_' => $request->all()]);
        $validator = Validator::make($request->only('starts_at', 'ends_at', 'title', 'content'),
            [
                'starts_at' => [
                    'required',
                    //'date_format:Y-m-d',
                    //'date_format:H:i'
                ],
                'ends_at' => [
                    'required',
                    //'date_format:Y-m-d',
                    //'date_format:H:i'
                ],
                'title' => [
                    'required',
                    'max:30'
                ],
                'content' => [
                    'max:200'
                ]
            ]
        );

        $validator->validate();

        $schedule->forceFill($request->only('starts_at', 'ends_at', 'title', 'content'));
        $schedule->save();

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
