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
                    <h4 class="card-title"> Exam Sessions </h4>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="student-table" class="table">
                                    <thead class="text-info">
                                        <th> Exam Session </th>
                                        <th> Description </th>
                                        <th> Start Date </th>
                                        <th> Registration Deadline </th>
                                        <th> Status </th>
                                        <th hidden> Edit </th>
                                        <th hidden> Delete </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam_sessions as $es)
                                
                                        <tr>
                                            <td> {{$es->exam_session_name}} </td>
                                            <td> {{$es->description}} </td>
                                            <td> {{$es->start_date}} </td>
                                            <td> {{$es->registration_deadline}} </td>
                                            <td> {{$es->status}} </td>
                                            <td>
                                                <a href="{{url('admin/edit-exam_session/'.$es->id)}}" class="btn btn-info">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{url('admin/delete-exam_session/'.$es->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure You want to delete {{$es->exam_session_name}} from the system ')">Delete</a>
                                            </td>
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
