@extends('layouts.master')

@section('title')
    Units | myExam
@endsection

@section('page_name')
    Units
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

                        <form action="{{route('admin.viewunits')}}" method="post">
                            {{ csrf_field() }} 
                
                            <div class="form-group mb-3">
                                <label for="course">Unit Name</label>
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

                            <div class="form-group mb-3">
                                <label for="exam_session_id">Exam Session</label>
                                <select class="form-control @error('exam_session_id') border border-danger @enderror" id="exam_session_id" name="exam_session_id">
                                    <option value="">Select Exam Session</option>
                                    @foreach($exam_sessions as $es)
                                        <option value="{{ $es->id }}">{{ $es->exam_session_name }}</option>
                                    @endforeach
                                </select>

                                @error('exam_session_id')
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
                                        <th> Unit Name </th>
                                        <th> Description </th>
                                        <th> Exam Date </th>
                                        <th> Exam Venue </th>
                                        <th> Exam Session </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($units as $unit)
                                
                                        <tr>
                                            <td> {{$unit->unit_name}} </td>
                                            <td> {{$unit->description}} </td>
                                            <td> {{$unit->exam_date}} </td>
                                            <td> {{$unit->exam_venue}} </td>
                                            <td> {{$unit->exam_session_id}} </td>
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
