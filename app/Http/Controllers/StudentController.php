<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ExamSession;
use App\Models\RetakeRequest;
use App\Models\SpecialRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\UnitExam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.dashboard');
    }

    public function stdProfile(){
        $userID = Auth::id();
        $users = User::where('id', $userID)->first();
        $students = Student::where('user_id', $userID)->first();
        $courses = Course::all();
        return view('student.profile' , compact('users', 'students', 'courses'));
    }

    public function profileUpdate(Request $request)
    {
        $userID = Auth::id();
        $user = User::find($userID);
        $student = Student::where('user_id', $userID)->first();

        if (!$user) {
            return redirect('student/profile')->with('message', 'User not found');
        }

        if (!$student) {
            return redirect('student/profile')->with('message', 'Student record not found');
        }

        // Validate input
        $validatedData = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable'],
            'phone_number' => ['nullable', 'integer'],
            'course_id' => ['nullable', 'integer'],
        ]);

        // Update user attributes
        $user->fill($validatedData);
        $user->save();

        // Update student attributes
        if (array_key_exists('course_id', $validatedData)) {
            $student->course_id = $validatedData['course_id'];
            $student->save();
        }

        return redirect('student/profile')->with('status', 'Profile edited successfully');
    }


    public function view_special(){
        $units = Unit::all();

        return view('student.special_form', compact('units'));
    }

    public function store_special(Request $request)
    {
        $this->validate($request, [
            'unit_id' => 'required|integer|max:255',
            'reason' => 'required|string|max:255',

        ]);
        $userID = Auth::id();
        $studentID = Student::where('user_id', $userID)->value('id'); // retrieve the id attribute
        $defaultStatus = "pending";

        //the unit exam is added once th eadmin approves the request

        SpecialRequest::create(
            [
                'student_id' => $studentID,
                'unit_id' => $request->unit_id,
                'reason' => $request->reason,
                'status' => $defaultStatus,
            ]
        );

        return redirect('student/special_request_form')->with('status', 'Request Form submitted successfully');
    }

    public function view_retake(){
        $exam_session = ExamSession::all();
        
        return view('student.retake_form', compact('exam_session'));
    }

    public function retake_cont(Request $request){
        $exam_session = $request->exam_session;
        $userID = Auth::id();
        $studentID = Student::where('user_id', $userID)->value('id');
        $unit_exam = UnitExam::where('exam_session', $exam_session)->get();
        $units = Unit::all();

        //compare now date and registration deadline
        $examSession = ExamSession::find($exam_session);
        $registrationDeadline = Carbon::parse($examSession->registration_deadline);
        $currentDate = Carbon::now();

        if($currentDate->gt($registrationDeadline)){
            //Registration Deadline has passed therefore return back with error message
            return redirect()->back()->with('message', 'The registration deadline for this exam period has already passed.');
        }
        return view('student.retake_continuation', compact('unit_exam', 'studentID', 'units'));
    }

    public function store_retake(Request $request){
        $this->validate($request, [
            'student_id' => 'required',
            'unit_exam' => 'required',
            'exam_marks' => 'required',

        ]);
        $defaultStatus = "Awaiting Payment";
        $retakeRequest = RetakeRequest::create(
            [
                'student_id' => $request->student_id,
                'unit_exam' => $request->unit_exam,
                'previous_marks' => $request->exam_marks,
                'status' => $defaultStatus,
            ]
        );

        $payment_for = "retake";
        $amount = (15/100)*(200000/7);
        $requestID = $retakeRequest->id;
        $studentID = $request->student_id;
        $unit = $request->unit_exam;

        return view('student.payment', compact('studentID', 'payment_for', 'requestID', 'amount'));
    }


    public function application_history(){
        $userID = Auth::id();
        $studentID = Student::where('user_id', $userID)->value('id');
        
        $specialRequests = SpecialRequest::where('student_id', $studentID)->get();

        return view('student.application_history', compact('specialRequests'));
    }

    
}
