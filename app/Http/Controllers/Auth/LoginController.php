<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\RecaptchaService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    protected $recaptcha;
    public function __construct(RecaptchaService $recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        // reCAPTCHA doğrulaması

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
