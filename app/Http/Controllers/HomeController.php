<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\kost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index() {
        $user = User::all();

        return response()->json($user, 200);
    }

    public function register(Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User',
        ]);

        if($user){
            http_response_code(201);
            return response()->json(['message' => 'succesfuly']);
        } else {
            http_response_code(400);
            return response()->json(['message' => 'gagal']);
        }
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('kode_rahassia')->accessToken;
            $token = $user->createToken('kode_rahassia')->plainTextToken;

            return response()->json(['token' => $token, 'role'=> $user->role], 200);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
