<?php

namespace App\Extensions;

use Illuminate\Http\JsonResponse;

trait RestfulResourceTrait
{
    /**
     * Response failed
     *
     * @param string $message
     * @param int $status
     *
     * @return JsonResponse
     */
    protected function failed(string $message = '', int $status = 400) : JsonResponse
    {
        return response()->json([
            'is_success' => false,
            'message' => $message,
            'data' => [],
        ], $status);
    }
    /**
     * Response success
     *
     * @param $data
     * @param string $message
     * @param int $status
     *
     * @return JsonResponse
     */
    protected function success($data, string $message = '', int $status = 200) : JsonResponse
    {
        return response()->json([
            'is_success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
