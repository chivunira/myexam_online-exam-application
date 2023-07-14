@extends('layouts.s_master')

@section('title')
    Student Profile | myExam
@endsection

@section('page_name')
    Student Profile
@endsection

@section('content')
<div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Edit Profile</h5>
          </div>
          <div class="card-body">
            <form action="{{route('student.profile')}}" method="post">
                {{ csrf_field() }}
                @method('PUT')
                <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-control" disabled value={{$users->id}}>
                        </div>
                    </div>
            
                    <div class="col-md-6 pl-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" disabled value={{$users->email}}>
                        </div>
                    </div>  
                </div>

                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="fist_name" name="first_name" class="form-control" placeholder="First Name" value={{$users->first_name}}>
                        </div>
                    </div>

                    <div class="col-md-6 pl-1">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value={{$users->last_name}}>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Course</label>
                            <select class="form-control" id="course_id" name="course_id">
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 pl-1">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">{{$users->gender}}</option>
                                <option value="male"> Male </option>
                                <option value="female"> Female </option>
                                <option value="non binary"> Prefer Not To Say</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" 
                                value="{{ $users->phone_number }}" required
                                title="Please enter a valid phone number with country code (e.g. 254712345678)"
                                data-toggle="tooltip" data-placement="bottom">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info">Submit</button>
                <button type="reset" class="btn btn-danger">Clear</button>
            </form>
          </div>
        </div>
      </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="../assets/img/bg5.jpg" alt="...">
                </div>
            <div class="card-body">
                <div class="author">
                        <img class="avatar border-gray" src="../assets/img/mike.jpg" alt="...">
                        <h5 class="title">{{$users->first_name}}</h5>
                        <p class="description">Student ID : {{$students->id}}</p>
                        <p class="description">User ID : {{$users->id}}</p>
                        <p class="description">Phone Number : {{$users->phone_number}}</p>
                </div>
            </div>
            <hr>
            </div>
        </div>
    </div>
</div>
@endsection

