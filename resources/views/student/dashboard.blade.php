@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                @php
                    $user = Auth::user(); // logic that handles users after email verification

                    if ($user->last_login == null) {
                        session()->flash('status', 'Email verification was successful');
                    }

                    $user->last_login = now();
                    $user->save();
                @endphp

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


                    {{ __('Students Dashboard!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
