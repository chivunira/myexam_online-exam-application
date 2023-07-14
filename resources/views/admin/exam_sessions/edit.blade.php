@extends('layouts.master')

@section('title')
    Exam Sessions | myExam
@endsection

@section('page_name')
    Exam Sessions
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Add an Exam Session</h4>
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

                        <form action="{{route('admin.viewexam_sessions')}}" method="post">
                            {{ csrf_field() }}
                            @method('PUT') 
                
                            <div class="form-group mb-3">
                                <label for="exam_session_name">Exam Session name</label>
                                <input type="text" class="form-control @error('exam_session_name') border border-danger @enderror" id="exam_session_name" name="exam_session_name">
                            
                                @error('exam_session_name')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control @error('description') border border-danger @enderror" id="description" name="description">
                            
                                @error('description')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control @error('start_date') border border-danger @enderror" id="start_date" name="start_date">
                            
                                @error('start_date')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="status" id="status">
                                  <span class="form-check-sign"></span>
                                  End Exam Session
                                </label>
                              </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <a class="btn btn-danger" href="{{route('admin.viewexam_sessions')}}">Back to Unit Exam Sessions</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
