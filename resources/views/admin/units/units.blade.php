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
                    <h4 class="card-title"> Add a Unit</h4>
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
                                <label for="unit_name">Unit Name</label>
                                <input type="text" class="form-control @error('unit_name') border border-danger @enderror" id="unit_name" name="unit_name">
                            
                                @error('unit_name')
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
                    <h4 class="card-title"> Available Units </h4>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="unit-table" class="table">
                                    <thead class="text-info">
                                        <th> Unit Name </th>
                                        <th> Description </th>
                                        <th hidden> Edit </th>
                                        <th hidden> Delete </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($units as $unit)
                                
                                        <tr>
                                            <td> {{$unit->unit_name}} </td>
                                            <td> {{$unit->description}} </td>
                                            <td>
                                                <a href="{{url('admin/edit-unit/'.$unit->id)}}" class="btn btn-info">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{url('admin/delete-unit/'.$unit->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure You want to delete [{{$unit->unit_name}}] from the system ')">Delete</a>
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
        $('#unit-table').DataTable({
            paging: true, // Enable pagination
            searching: true, // Enable search bar
            responsive: true,
        });
    });
    </script>
@endsection
