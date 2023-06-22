@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Successful Email Verification') }}</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ __('Your email was successfully verified') }}
                    </div>
                    {{ __('Click on the link provided to proceed to the login page.') }}

                    <form class="" method="POST" action="{{ route('s.verification') }}">
                        @csrf
                        <div class="m-5">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
