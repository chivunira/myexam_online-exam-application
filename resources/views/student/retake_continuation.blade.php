@extends('layouts.s_master')

@section('title')
    Retake Exam Request Form | myExam
@endsection

@section('page_name')
    Retake Exam
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Retake Request Form</h4>
                </div>
                    <div class="card-body">
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session('start_date'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('start_date') }}
                            </div>
                        @endif

                        <form action="{{route('retake.finalize')}}" method="post">
                        {{ csrf_field() }} 

                            <div class="form-group mb-3">
                                <label for="student_id">Student ID</label>
                                <input type="number" class="form-control @error('student_id') border border-danger @enderror" id="student_id" name="student_id" value="{{$studentID}}" disabled>
                                <input type="number" class="form-control @error('student_id') border border-danger @enderror" id="student_id" name="student_id" value="{{$studentID}}" hidden>

                                @error('student_id')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="unit_exam">Which Unit Exam do you wish to register for ?</label>
                                <select class="form-control @error('unit_exam') border border-danger @enderror" id="unit_exam" name="unit_exam">
                                    <option value="">Select a Unit Exam</option>
                                    @foreach($unit_exam as $ue)
                                        <option value="{{ $ue->id }}">{{ $units->where('id', $ue->unit_id)->pluck('unit_name')->first(); }}</option>
                                    @endforeach
                                </select>

                                @error('unit_exam')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="exam_marks">Previous Exam Marks</label>
                                <input type="number" class="form-control @error('exam_marks') border border-danger @enderror" id="exam_marks" name="exam_marks">

                                @error('student_id')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-info">Proceed to Payment</button>
                            <a class="btn btn-danger" href="{{route('student.retakerequest')}}">Back to Exam Period selection</a>
                        </form> 
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

