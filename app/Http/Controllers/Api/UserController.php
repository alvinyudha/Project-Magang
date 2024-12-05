<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseFormatter; // Jika ResponseFormatter adalah kelas Anda sendiri

class UserController extends Controller
{
    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data profile user berhasil diambil');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Username atau Password tidak ditemukan', 401);
            }

            // Memastikan bahwa hanya role 'superadmin' yang diizinkan untuk login
            if (!$user->hasRole('officer')) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Akun tidak memiliki izin untuk login', 403);
            }

            $tokenResult = $user->createToken('authToken');
            $accessToken = $tokenResult->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $accessToken,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Login Berhasil', 200);

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Sepertinya ada yang salah',
                'error' => $error->getMessage(),
            ], 'Login gagal, Akun Anda tidak ditemukan', 500);
        }
    }
    
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return ResponseFormatter::success([], 'Logout berhasil');
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Sepertinya ada yang salah',
                'error' => $error->getMessage(),
            ], 'Logout Gagal', 500);
        }
    }
}
