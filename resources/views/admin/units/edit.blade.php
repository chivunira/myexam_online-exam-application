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

                        <form action="{{url('admin/update-unit/'.$unit->id)}}" method="post">
                            {{ csrf_field() }} 
                            @method('PUT')
                
                            <div class="form-group mb-3">
                                <label for="unit_name">Unit Name</label>
                                <input type="text" value="{{$unit->unit_name}}" class="form-control @error('unit_name') border border-danger @enderror" id="unit_name" name="unit_name">
                            
                                @error('unit_name')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <input type="text" value="{{$unit->description}}" class="form-control @error('description') border border-danger @enderror" id="description" name="description">
                            
                                @error('description')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <a class="btn btn-danger" href="{{route('admin.viewunits')}}">Back to Units</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

