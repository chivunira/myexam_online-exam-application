@extends('layouts.master')

@section('title')
    Courses Edit | myExam
@endsection

@section('page_name')
    Edit Course 
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Edit the Course </h4>
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

                        <form action="{{url('admin/update-course/'.$course->id)}}" method="post">
                            {{ csrf_field() }} 
                            @method('PUT')
                
                            <div class="form-group mb-3">
                                <label for="course">Course Name</label>
                                <input type="text" value="{{$course->course}}" class="form-control @error('course') border border-danger @enderror" id="course" name="course">
                            
                                @error('course')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <input type="text" value="{{$course->description}}" class="form-control @error('description') border border-danger @enderror" id="description" name="description">
                            
                                @error('description')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a class="btn btn-danger" href="{{route('admin.viewcourses')}}">Back to Courses</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
