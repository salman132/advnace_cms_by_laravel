@extends('layouts.admin')

@section('content')




<div class="auth-wrapper">
    <div class="container-fluid h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                <div class="lavalite-bg" style="">
                    <div class="lavalite-overlay"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                <div class="authentication-form mx-auto">
                    <div class="logo-centered">
                        <a href="{{url('/')}}"><img src="" alt=""></a>
                    </div>
                    <h3>Forgot Password</h3>
                    <p>We will send you a link to reset password.</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <i class="ik ik-mail"></i>
                        </div>
                        <div class="sign-btn text-center">
                            <button class="btn btn-theme">Submit</button>
                        </div>
                    </form>
                    <div class="register">
                        <p>Not a member? <a href="{{route('register')}}">Create an account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
