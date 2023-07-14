{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        @if(session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid border border-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" onpaste="return false;" class="form-control @error('password') is-invalid border border-danger @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" onpaste="return false;" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('title')
    Registration | myExam
@endsection

@section('page_name')
    Registration
@endsection

@section('content')
<div class="chivu">
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Registration</h4>
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
    
                            <form action="{{ route('register') }}" method="post">
                            {{ csrf_field() }} 
    
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') border border-danger @enderror" id="email" name="email"  value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <div class="fw-light text-danger" >
                                            {{$message}}
                    
                                        </div>
                                    @enderror
                                </div>
    
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" onpaste="return false;" class="form-control @error('password') border border-danger @enderror" id="password" name="password">
    
                                    @error('password')
                                        <div class="fw-light text-danger" >
                                            {{$message}}
                    
                                        </div>
                                    @enderror
                                </div>
    
                                <div class="form-group mb-3">
                                    <label for="password-confirm">Password</label>
                                    <input type="password" onpaste="return false;" class="form-control @error('password-confirm') border border-danger @enderror" id="password-confirm" name="password-confirm">
    
                                    @error('password-confirm')
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
</div>
@endsection

