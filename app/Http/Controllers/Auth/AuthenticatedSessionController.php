<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $user = $request->user();
        $user->tokens()->delete();
        $token = $user->createToken('api-token');
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {


        $token = $request->user()->currentAccessToken();

        if(!$token){return response()->json([false]);}

        $sessionTermination = $token->delete();
        if ($sessionTermination){
            return response()->json([
                "success"=>true,
                "message"=>"logged out successfully"
            ]);
        } else {
            return response()->json([
                "success"=>false,
                "message"=>"An error has occured"
            ]);
        };
    }
}
