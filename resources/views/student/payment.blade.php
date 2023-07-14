@extends('layouts.s_master')

@section('title')
    Invoice | myExam
@endsection

@section('page_name')
    Invoice
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Payment Invoice</h4>
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

                        <form action="#" method="post">
                        {{ csrf_field() }} 

                            <div class="form-group mb-3">
                                <label for="student_id">Student ID</label>
                                <input type="number" class="form-control @error('student_id') border border-danger @enderror" id="student_id" name="student_id" value="{{$studentID}}" disabled>
                                <input type="number" class="form-control @error('student_id') border border-danger @enderror" id="student_id" name="student_id" value="{{$studentID}}" hidden>

                                @error('student_id')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="payment_for"> Paid for:</label>
                                <input type="number" class="form-control @error('payment_for') border border-danger @enderror" id="payment_for" name="payment_for" value="{{$payment_for}}" disabled>
                                <input type="number" class="form-control @error('payment_for') border border-danger @enderror" id="payment_for" name="payment_for" value="{{$payment_for}}" hidden>

                                @error('payment_for')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="requestID"> Request ID:</label>
                                <input type="number" class="form-control @error('requestID') border border-danger @enderror" id="requestID" name="requestID" value="{{$requestID}}" disabled>
                                <input type="number" class="form-control @error('requestID') border border-danger @enderror" id="requestID" name="requestID" value="{{$requestID}}" hidden>

                                @error('requestID')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="amount"> Amount:</label>
                                <input type="number" class="form-control @error('amount') border border-danger @enderror" id="amount" name="amount" value="{{$amount}}" disabled>
                                <input type="number" class="form-control @error('amount') border border-danger @enderror" id="amount" name="amount" value="{{$amount}}" hidden>

                                @error('amount')
                                    <div class="fw-light text-danger" >
                                        {{$message}}
                
                                    </div>
                                @enderror
                            </div>

                            <a class="btn btn-info" href="{{route('stk_push')}}">Make Payment</a>
                        </form> 
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

