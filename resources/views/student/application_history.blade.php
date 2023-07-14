@extends('layouts.s_master')

@section('title')
    Application History | myExam
@endsection

@section('page_name')
    Application History
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Special Exam Requests </h4>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="student-table" class="table">
                                    <thead class=" text-info">
                                        <th> Request ID </th>
                                        <th> Reason </th>
                                        <th> Unit Exam </th>
                                        <th> Status </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($specialRequests as $srequest)
                                
                                        <tr>
                                            <td> {{$srequest->id}} </td>
                                            <td> {{$srequest->reason}} </td>
                                            <td> {{$srequest->unit_exam}} </td>
                                            <td> {{$srequest->status}} </td>
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

        {{-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Retake Exam Requests </h4>
                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="lec-table" class="table">
                                    <thead class=" text-info">
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Email </th>
                                        <th> Subject </th>
                                        <th> Phone Number </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($lecturers as $lecturer)
                                                
                                        <tr>
                                            <td> {{$lecturer->first_name}} </td>
                                            <td> {{$lecturer->lasr_name}} </td>
                                            <td> {{$lecturer->email}} </td>
                                            <td> {{$lecturer->subject}} </td>
                                            <td> {{$lecturer->phone_number}} </td>
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

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Exam Remark Requests </h4>
                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="lec-table" class="table">
                                    <thead class=" text-info">
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Email </th>
                                        <th> Subject </th>
                                        <th> Phone Number </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($lecturers as $lecturer)
                                                
                                        <tr>
                                            <td> {{$lecturer->first_name}} </td>
                                            <td> {{$lecturer->lasr_name}} </td>
                                            <td> {{$lecturer->email}} </td>
                                            <td> {{$lecturer->subject}} </td>
                                            <td> {{$lecturer->phone_number}} </td>
                                        </tr>
        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
