<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'country' => $request['country'],
            'email' => $request['email'],
            'email_verification_code' => md5(rand(0,6)), // Make verif.code better later.
            'password' => Hash::make($request['password']),
        ]);

        if ($user) {
            return response()->json(['data' => [
                'success' => true
            ]]);
        } else {
            return response()->json(['errors' => [
                'root' => 'Cannot create user.'
            ]]);
        }
    }
}
