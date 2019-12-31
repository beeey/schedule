<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class CalendarController extends Controller
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->response = $responseFactory;
    }

    public function get(Request $request)
    {
        return $this->response->json(['data' => [
            ['title' => '仕事', 'start' => '2020-01-01 00:00:00', 'end' => '2020-01-01 02:00:00'],
            ['title' => '仕事', 'start' => '2020-01-02 01:00:00', 'end' => '2020-01-02 03:00:00'],
            ['title' => '仕事', 'start' => '2020-01-03 02:00:00', 'end' => '2020-01-03 04:00:00'],
            ['title' => '仕事', 'start' => '2020-01-04 03:00:00', 'end' => '2020-01-04 05:00:00'],
        ]]);
    }

    public function store(Request $request)
    {
        try {

        } catch (Exception $e) {

        }
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
