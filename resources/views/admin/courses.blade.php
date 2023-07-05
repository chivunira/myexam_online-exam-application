@extends('layouts.master')

@section('title')
    Courses | myExam
@endsection

@section('page_name')
    Courses
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Add a Course </h4>
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

                        <form action="{{route('admin.viewcourses')}}" method="post">
                            {{ csrf_field() }} 
                
                            <div class="form-group mb-3">
                                <label for="course">Course Name</label>
                                <input type="text" class="form-control @error('course') border border-danger @enderror" id="course" name="course">
                            
                                @error('course')
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
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Available Courses </h4>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="student-table" class="table">
                                    <thead class="text-info">
                                        <th> Course ID </th>
                                        <th> Course Name </th>
                                        <th> Description </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                
                                        <tr>
                                            <td> {{$course->id}} </td>
                                            <td> {{$course->course}} </td>
                                            <td> {{$course->description}} </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#student-table').DataTable({
            paging: true, // Enable pagination
            searching: true, // Enable search bar
        });

        $('#lec-table').DataTable({
            paging: true, // Enable pagination
            searching: true, // Enable search bar
        });
    });
    </script>
@endsection
