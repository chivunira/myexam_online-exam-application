<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ExamSession;
use App\Models\Unit;
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

    public function view_course()
    {
        $courses = Course::all();

        return view('admin.courses', compact('courses'));
    }

    public function add_course(Request $request)
    {
        $this->validate($request, [
            'course' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        Course::create(
            [
                'course' => $request->course,
                'description' => $request->description,
            ]
        );

        return redirect('admin/view_courses')->with('status', 'Course added successfully');
    }

    public function view_unit()
    {
        $units = Unit::all();
        $exam_sessions = ExamSession::all();

        return view('admin.units', compact('units', 'exam_sessions'));
    }

    public function add_unit(Request $request)
    {
        $this->validate($request, [
            'unit_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_venue' => 'required|string|max:255',
            'exam_session_id' => 'required|integer',

        ]);

        // $examDate = $request->exam_date;
        // $registrationDeadline = date('Y-m-d', strtotime('-14 days', strtotime($examDate)));
        // // exam registration deadline is 2 weeks to the exam starting date

        Course::create(
            [
                'unit_name' => $request->course,
                'description' => $request->description,
                'exam_date' => $request->exam_date,
                'exam_venue' => $request->exam_venue,
                'exam_session_id' => $request->exam_session_id,
            ]
        );

        return redirect('admin/view_units')->with('status', 'Unit exam added successfully');
    }
}
