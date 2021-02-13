<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use App\Models\TempUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    // use VerifiesEmails;

    // /**
    //  * Where to redirect users after verification.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('verify', 'resend');
    // }

    public function verify(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'token' => 'required'
        ]);

        $tempUser = TempUser::find($request->id);

        if ($tempUser && $request->token == $tempUser->email_verification_code) {
            $tempUser->email_verification_code = md5(rand(0, 6));
            $tempUser->save();
            
            $userName = $tempUser->name;
            $userCountry = $tempUser->country;
            $userEmail = $tempUser->email;
            $userEmailVerifCode = $tempUser->email_verification_code;
            $userPassword = $tempUser->password;
            
        }
        // Move Temporary User to Verified User table.
        if($tempUser) {
            $user = new User();
            $user->name = $userName;
            $user->country = $userCountry;
            $user->email = $userEmail;
            $user->email_verification_code = $userEmailVerifCode;
            $user->email_verified_at = now();
            $user->password = $userPassword;
            $user->save();
            // Delete Temp User Row
            $tempUser->delete();

            return response()->json(['data' => [
                'success' => true
            ]]);
        } else {
            return response()->json(['data' => [
                'success' => false
            ]]);
        }

    }









    // public function verified(Request $request, User $user)
    // {
    //     $request->validate([
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //         'password' => ['required'],
    //     ]);

    //     $user = User::where('email', $request['email'])->first();
        
    //     if ($user == null){

    //         return response()->json([
    //             'validUser' => true,
    //         ]);
    //     } elseif ($user && $user->email_verified_at != null ) {
    //         return response()->json([
    //             'validUser' => true
    //         ]);
    //     } elseif ($user && $user->email_verified_at == null) {
    //         return response()->json([
    //             'validUser' => false
    //         ]);
    //     }
    // }
}
