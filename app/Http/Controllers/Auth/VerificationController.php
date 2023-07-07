<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
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

    use VerifiesEmails;

    // /**
    //  * Where to redirect users after verification.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    public function show()
    {
        return view('auth.verify');
    }

    public function sverification()
    {
        return view('passwords.confirmation_message');
    }

    public function redirectTo()
    {
        Auth::login(Auth::user());
        // Check the role of the authenticated user
        $user = Auth::user();

        if ($user->role_id == 3) {
            return '/admin/dashboard'; // Redirect to the admin dashboard
        } elseif ($user->role_id == 1) {
            return '/student/dashboard'; // Redirect to the manager dashboard
        } else {
            return '/lecturer/dashboard'; // Redirect to the user dashboard
        }
    }
}
