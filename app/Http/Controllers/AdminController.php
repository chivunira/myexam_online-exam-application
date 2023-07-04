<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function view_users()
    {
        $students = User::where('role_id', '1')->get();
        $lecturers = User::where('role_id', '2')->get();

        return view('admin.users', compact('students', 'lecturers'));
    }
}
