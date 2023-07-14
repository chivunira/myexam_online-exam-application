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

                        <form action="{{route('student.retakecont')}}" method="post">
                            {{ csrf_field() }} 

                            <div class="form-group mb-3">
                                <label for="exam_session">Which Exam Period do you wish to register in ?</label>
                                <select class="form-control @error('exam_session') border border-danger @enderror" id="exam_session" name="exam_session">
                                    <option value="">Select Exam Period</option>
                                    @foreach($exam_session as $es)
                                        <option value="{{ $es->id }}">{{ $es->exam_session_name }} (Start Date: {{ $es->start_date }})</option>
                                    @endforeach
                                </select>

                                @error('exam_session')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

