@extends('layouts.master')

@section('title')
    Unit Exams | myExam
@endsection

@section('page_name')
    Unit Exams
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Add a Unit Exam</h4>
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

                        <form action="{{url('admin/update-unit_exam/'.$unit_exams->id)}}" method="post">
                            {{ csrf_field() }} 
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="exam_session">Exam Session</label>
                                <select class="form-control @error('exam_session') border border-danger @enderror" id="exam_session" name="exam_session">
                                    <option value="{{$unit_exams->exam_session}}">Select Exam Session</option>
                                    @foreach($exam_sessions as $es)
                                        <option value="{{ $es->id }}">{{ $es->exam_session_name }} ({{$es->description}})</option>
                                    @endforeach
                                </select>

                                @error('exam_session')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="exam_date">Exam Date</label>
                                <input type="date" value="{{$unit_exams->exam_date}}" class="form-control @error('exam_date') border border-danger @enderror" id="exam_date" name="exam_date">
                            
                                @error('exam_date')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="exam_venue">Exam Venue</label>
                                <input type="text" value="{{$unit_exams->exam_venue}}" class="form-control @error('exam_venue') border border-danger @enderror" id="exam_venue" name="exam_venue">
                            
                                @error('exam_venue')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <a class="btn btn-danger" href="{{route('admin.viewunit_exams')}}">Back to Unit Exams</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
