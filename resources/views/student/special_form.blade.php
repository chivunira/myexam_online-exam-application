@extends('layouts.s_master')

@section('title')
    Special Exam Request Form | myExam
@endsection

@section('page_name')
    Special Exam
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Request Form</h4>
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

                        <form action="{{route('student.specialrequest')}}" method="post">
                            {{ csrf_field() }} 

                            <div class="form-group mb-3">
                                <label for="unit_id">Which Unit did you miss ?</label>
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
                                <label for="reason">Why did you miss the exam ?</label>
                                <textarea type="text" class="form-control @error('reason') border border-danger @enderror" id="reason" name="reason" rows="5"></textarea>
                            
                                @error('reason')
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
    </div>
</div>
@endsection

