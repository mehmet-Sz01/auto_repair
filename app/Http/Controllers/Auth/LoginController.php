<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {


        $userControl = [
            'user_name' => $request->user_name,
            'password' => $request->password,
        ];

        if (Auth::attempt($userControl)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Giriş Başarılı',
                'token' => $token,
                'user' => $user,
                'user_type' => $user->user_type, // Kullanıcının rolünü burada döndürüyoruz.
            ], 200);
        } else {
            return response()->json('Giriş Başarısız', 401);
        }
    }
    public function logout(): JsonResponse
    {
        Session::flush();
        return response()->json('Çıkış İşlemi Başarılı');
    }
}
