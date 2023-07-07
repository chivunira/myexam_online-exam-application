<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //directs user to dashboard
        if (Auth::user()->role_id == '3') // admin -> 1
        {
            return redirect('admin/dashboard');
        } else if (Auth::user()->role_id == '1') {
            return redirect('student/dashboard');
        } else {
            return redirect('lecturer/dashboard');
        }
    }
}
