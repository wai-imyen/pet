<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function out($status = 200, $data = [], $message = '')
    {
        return response()->json(['status' => $status, 'data' => $data, 'message' => $message])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
