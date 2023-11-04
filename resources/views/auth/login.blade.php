@extends('layouts.app')

@section('title')
    Login | myExam
@endsection

@section('page_name')
    Login
@endsection

@section('content')
<div class="chivu">
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Login</h4>
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
    
                            <form action="{{ route('loginn') }}" method="post">
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

                                <div class="form-check">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                      <span class="form-check-sign"></span>
                                      Remember Me
                                    </label>
                                  </div>

                                <div class="form-group mb-3">
                                    <div class="">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
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
