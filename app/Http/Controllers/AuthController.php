<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response(['status' => false, 'message' => 'This Email not Registered with Us'], 401);
        }


        if (!Hash::check($request->password, $user->password)) {
            return response(['status' => false, 'message' => 'Invalid Password'], 401);
        }

        $token = $user->createToken('API Token')->accessToken;

        return response(['status' => true, 'message' => 'Successfully login', 'token' => $token]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);


        try {

            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }

        $token = $user->createToken('API Token')->accessToken;

        return response(['status' => true, 'message' => 'User Register Successfully', 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['status' => true, 'message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
