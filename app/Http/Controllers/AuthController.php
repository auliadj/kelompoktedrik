<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
   public function register(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:50',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6',
       ]);


       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
       ]);


       return response()->json([
           'message' => 'User berhasil didaftarkan',
           'user' => $user,
       ], 201);
   }


   public function login(Request $request)
   {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required',
       ]);


       $user = User::where('email', $request->email)->first();


       if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json([
               'message' => 'Email atau password salah',
           ], 401);
       }


       $token = $user->createToken('auth_token')->plainTextToken;


       return response()->json([
           'message' => 'Login berhasil',
           'user' => $user,
           'token' => $token,
       ], 200);
   }
}
