<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // /**
    //  * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 'string', 'confirmed',
                Password::min(8)->letters()->mixedCase()->symbols()
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    //create() method returns the user object instead of using the back()->with('message', ...) approach. 
    protected function create(array $data)
    {
        $email = $data['email'];
        $firstPart = explode('@', $email)[0]; // get first part of email before @ symbol
        $parts = explode('.', $firstPart); //split the part of the first part which are separated by the (.)

        if (count($parts) == 2 && str_ends_with($email, 'strathmore.edu')) {
            $role_id = 1; // student has role_id 1 in db
        } elseif (count($parts) == 2 && str_ends_with($email, '@gmail.com')) {
            $role_id = 2;
        } elseif (count($parts) == 1 && str_ends_with($email, '@gmail.com')) {
            $adminExists = User::where('role_id', 3)->exists();

            if ($adminExists) {
                return back()->with('message', 'Account creation is restricted for this email format.');
            } else {
                $role_id = 3;
            }
        } else {
            return back()->with('message', 'Kindly use a valid school email address');
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role_id
        ]);

        return $user;
    }

    //register() method, checks if the returned value is an instance of RedirectResponse. 
    //If it is, we return it directly to perform the redirection with the error message. 
    //Otherwise, we proceed with logging in the user and redirecting to the intended location.
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        if ($user instanceof RedirectResponse) {
            return $user; // Redirect with error message
        }

        // // Otherwise, login the user and redirect to the intended location
        $this->guard()->login($user);
        return redirect($this->redirectPath());
    }
}
