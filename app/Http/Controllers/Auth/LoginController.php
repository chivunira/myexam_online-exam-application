<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'), $request->remember)) {
            //directs user to dashboard
            //return redirect()->route('dashboard');
            if (Auth::user()->role_id == '3') // admin -> 1
            {
                return redirect('admin/dashboard')->with('status', 'Welcome back');
            } else if (Auth::user()->role_id == '1') {
                return redirect('student/dashboard')->with('status', 'Welcome back');
            } else {
                return redirect('lecturer/dashboard')->with('status', 'Login Successful');
            }
        } else {
            return back()->with('message', 'Invalid login details');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user_login')->with('success', 'Successfully Logged out');
    }
}





// public function redirectTo()
    // {
    //     if (Auth::check()) {
    //         // Check the role of the authenticated user
    //         $user = Auth::user();

    //         if ($user->role_id == 0) {
    //             return '/admin/dashboard'; // Redirect to the admin dashboard
    //         } elseif ($user->role_id == 1) {
    //             return '/student/dashboard'; // Redirect to the manager dashboard
    //         } else {
    //             return '/lecturer/dashboard'; // Redirect to the user dashboard
    //         }
    //     }

    //     return RouteServiceProvider::HOME;
    // }