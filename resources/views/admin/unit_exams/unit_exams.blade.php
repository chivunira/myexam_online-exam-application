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

                        <form action="{{route('admin.viewunit_exams')}}" method="post">
                            {{ csrf_field() }} 

                            <div class="form-group mb-3">
                                <label for="unit_id">Unit</label>
                                <select class="form-control @error('unit_id') border border-danger @enderror" id="unit_id" name="unit_id">
                                    <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>

                                @error('unit_id')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="exam_session">Exam Session</label>
                                <select class="form-control @error('exam_session') border border-danger @enderror" id="exam_session" name="exam_session">
                                    <option value="">Select Exam Session</option>
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
                                <input type="date" class="form-control @error('exam_date') border border-danger @enderror" id="exam_date" name="exam_date">
                            
                                @error('exam_date')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="exam_venue">Exam Venue</label>
                                <input type="text" class="form-control @error('exam_venue') border border-danger @enderror" id="exam_venue" name="exam_venue">
                            
                                @error('exam_venue')
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
                    <h4 class="card-title"> Available Unit Exams </h4>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="student-table" class="table">
                                    <thead class="text-info">
                                        <th> Exam ID </th>
                                        <th> Unit ID</th>
                                        <th> Exam Session ID</th>
                                        <th> Exam Date </th>
                                        <th> Exam Venue </th>
                                        <th hidden> Edit </th>
                                        <th hidden> Delete </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($unit_exams as $exam)
                                
                                        <tr>
                                            <td> {{$exam->id}} </td>
                                            <td> {{$exam->unit_id}} </td>
                                            <td> {{$exam->exam_session}} </td>
                                            <td> {{$exam->exam_date}} </td>
                                            <td> {{$exam->exam_venue}} </td>
                                            <td>
                                                <a href="{{url('admin/edit-unit_exam/'.$exam->id)}}" class="btn btn-info">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{url('admin/delete-unit_exam/'.$exam->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure You want to delete the Unit Exam from the system ')">Delete</a>
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
