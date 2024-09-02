<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
class ApiBaseController extends Controller
{
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return Response::json($response, $code);
    }

    public function sendError($error, $errorMessage = "Authentication failed!", $code = 401)
    {
        $response = [
            'success' => false,
            'data' => $error,
            'message' => $errorMessage,
        ];

        return Response::json($response, $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}

