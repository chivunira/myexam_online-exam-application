<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ExamSession;
use App\Models\Unit;
use App\Models\UnitExam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('admin.courses.courses', compact('courses'));
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

    
    public function edit_course($id){
        $course = Course::find($id);
        return view('admin.courses.edit', compact('course'));
    }
        
    public function destroy_course($id){
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect('admin/view_courses')->with('status','Course deleted successfully');
    }

    public function update_course(Request $request, $id){
        $course = Course::find($id);
        $course->course = $request->course;
        $course->description = $request->description;
        $course->save();
        return redirect('admin/view_courses')->with('status','Course details edited successfully');
    }

    public function view_unit()
    {
        $units = Unit::all();
        $exam_sessions = ExamSession::all();

        return view('admin.units.units', compact('units', 'exam_sessions'));
    }

    public function add_unit(Request $request)
    {
        $this->validate($request, [
            'unit_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // $examDate = $request->exam_date;
        // $registrationDeadline = date('Y-m-d', strtotime('-14 days', strtotime($examDate)));
        // // exam registration deadline is 2 weeks to the exam starting date

        Unit::create(
            [
                'unit_name' => $request->unit_name,
                'description' => $request->description,
            ]
        );

        return redirect('admin/view_units')->with('status', 'Unit exam added successfully');
    }

    public function edit_unit($id){
        $unit = Unit::find($id);
        return view('admin.units.edit', compact('unit'));
    }
        
    public function destroy_unit($id){
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect('admin/view_units')->with('status','Unit deleted successfully');
    }

    public function update_unit(Request $request, $id){
        $unit = Unit::find($id);
        $unit->unit_name = $request->unit_name;
        $unit->description = $request->description;
        $unit->save();
        return redirect('admin/view_units')->with('status','Unit details edited successfully');
    }


    public function view_unit_exam()
    {
        $units = Unit::all();
        $exam_sessions = ExamSession::all();
        $unit_exams = UnitExam::all();

        return view('admin.unit_exams.unit_exams', compact('units', 'exam_sessions', 'unit_exams'));
    }

    public function add_unit_exam(Request $request){
        $this->validate($request, [
            'unit_id' => 'required|integer|max:255',
            'exam_session' => 'required|integer|max:255',
            'exam_date' => 'required|date',
            'exam_venue' => 'required|string|max:255',

        ]);

        $existingExam = UnitExam::where('unit_id', $request->unit_id)
        ->where('exam_session', $request->exam_session)
        ->first();

        if ($existingExam) {
            return redirect('admin/view_unit_exams')->with('message', 'This unit has already been assigned an exam in the given exam period');
        }

        $examSession = ExamSession::find($request->exam_session);

        if (!$examSession) {
            return redirect('admin/view_unit_exams')->with('message', 'Invalid exam session');
        }

        $startD = $examSession->start_date;
        if ($request->exam_date < $examSession->start_date) {
            return redirect('admin/view_unit_exams')->with('message', 'Selected exam date is before the start date of the exam session')->with('start_date', 'The exam session starts on: '.$startD);
        }

        UnitExam::create(
            [
                'unit_id' => $request->unit_id,
                'exam_session' => $request->exam_session,
                'exam_date' => $request->exam_date,
                'exam_venue' => $request->exam_venue,
            ]
        );

        return redirect('admin/view_unit_exams')->with('status', 'Unit exam added successfully');
    }

    public function edit_unit_exam($id){
        $exam_sessions = ExamSession::all();
        $unit_exams = UnitExam::find($id);
        return view('admin.unit_exams.edit', compact('unit_exams', 'exam_sessions'));
    }
        
    public function destroy_unit_exam($id){
        $unit_exams = UnitExam::findOrFail($id);
        $unit_exams->delete();
        return redirect('admin/view_unit_exams')->with('status','Unit deleted successfully');
    }

    public function update_unit_exam(Request $request, $id){
        $unitExam = UnitExam::find($id);
        $unitExam->exam_session = $request->exam_session;
        $unitExam->exam_date = $request->exam_date;
        $unitExam->exam_venue = $request->exam_venue;
        $unitExam->save();
        return redirect('admin/view_unit_exams')->with('status','Unit details edited successfully');
    }

    public function view_exam_session()
    {
        $exam_sessions = ExamSession::all();
        return view('admin.exam_sessions.exam_sessions', compact('exam_sessions'));
    }

    public function add_exam_session(Request $request)
    {
        $this->validate($request, [
            'exam_session_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date|max:255',
        ]);

        $startDate = $request->start_date;
        $registrationDeadline = date('Y-m-d', strtotime('-14 days', strtotime($startDate)));
        // exam registration deadline is 2 weeks to the exam starting date

        $defaultStatus = "Active";

        ExamSession::create(
            [
                'exam_session_name' => $request->exam_session_name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'registration_deadline' => $registrationDeadline,
                'status' => $defaultStatus,
            ]
        );

        return redirect('admin/view_exam_session')->with('status', 'Unit exam added successfully');
    }

    public function edit_exam_session($id){
        $exam_session = ExamSession::find($id);
        return view('admin.exam_sessions.edit', compact('exam_sessions'));
    }
        
    public function destroy_exam_session($id){
        $exam_session = ExamSession::findOrFail($id);
        $exam_session->delete();
        return redirect('admin/view_exam_session')->with('status','Exam Session deleted successfully');
    }

    public function update_exam_session(Request $request, $id){
        $exam_session = ExamSession::find($id);
        $exam_session->exam_session_name = $request->exam_session_name;
        $exam_session->description = $request->description;
        $exam_session->start_date = $request->start_date;

        //if admin alters start date it also alters the registration deadline
        $startDate = $request->start_date;
        $registrationDeadline = date('Y-m-d', strtotime('-14 days', strtotime($startDate)));
        //store updated deadline in db
        $exam_session->start_date = $registrationDeadline;

        //updating status
        if ($request->has('status')) {
            $exam_session->status = "ended";
        } else {
            $$exam_session->status = "active";
        }
    
        $exam_session->save();
        return redirect('admin/view_unit_exams')->with('status','Exam Session details edited successfully');
    }
}

