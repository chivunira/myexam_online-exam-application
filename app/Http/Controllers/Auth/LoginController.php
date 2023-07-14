<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

            $user = User::find(auth()->id());

            //on logging in, check if the user is a first time user
            //if yes the system adds the user to the lecturer or students table depending on their role
            // after adding the students, the system updates their last login fields to now.
            
            if($user->last_login == null){
                if (Auth::user()->role_id == '1') {
                    Student::create([
                        'user_id' => $user->id,
                    ]);
                    $user->update([
                        'last_login' => now(),
                    ]);
                    return redirect('student/dashboard')->with('status', 'Welcome To MyExam');

                } else {
                    Lecturer::create([
                        'user_id' => $user->id,
                    ]);
                    $user->update([
                        'last_login' => now(),
                    ]);
                    return redirect('lecturer/dashboard')->with('status', 'Login Successful');
                }
            }

            $user->update([
                'last_login' => now(),
            ]);

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