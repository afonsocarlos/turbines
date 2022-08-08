<?php

namespace App\Exceptions;

use App\Exceptions\NotFoundHttpException;
use App\Exceptions\MethodNotAllowedHttpException;


class Handler
{
    public static function setExceptionHandler()
    {
        set_exception_handler([self::class, 'handleException']);
    }

    public static function handleException($exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            http_response_code(404);
            echo json_encode([
                'status' => 404,
                'message' => 'Not Found',
            ]);
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            http_response_code(405);
            echo json_encode([
                'status' => 405,
                'message' => 'Method Not Allowed',
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'status' => 500,
                'message' => 'Internal Server Error',
            ]);
        }

        error_log($exception->getMessage());
    }
}
