<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class LogoutController extends Controller
{
    public function __invoke(Request $request) 
    {
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json(null, 200);
            
            throw new AuthenticationException();
    }
}