<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Get(
     *     path="/test",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
    public function test(): JsonResponse
    {
        return $this->success(['a' => 'a']);
    }
}
