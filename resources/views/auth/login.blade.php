@extends('layouts.admin')

@section('content')

<div class="auth-wrapper">
    <div class="container-fluid h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                <div class="lavalite-bg" style="background-image: url({{asset(config('BASE_BACKGROUND_IMAGE'))}})">
                    <div class="lavalite-overlay"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                <div class="authentication-form mx-auto">
                    <div class="logo-centered">
                        <a href="{{url('/')}}"><img src="" alt=""></a>
                    </div>
                    <h3>Sign In to {{config('app.site_name')}}</h3>
                    <p>Happy to see you again!</p>
                    @if(Config::get('USER_REGISTER') ==1)
                    <!-- Social Login -->
                    <div class="py-5">
                        <div class="text-info">You can login using </div>
                        <div class="row">
                            @if( !empty($facebook->value->status) && $facebook->value->status ==1)
                            <div class="col-md-2">
                                <a href="{{ route('login.provider',['provider'=>'facebook']) }}" id="facebook">
                                    <div class="facebook"><img src="{{ asset('uploads/images/facebook.png') }}" width="40px" height="40px" alt="facebook"></div>
                                </a>
                            </div>
                            @endif

                            @if(!empty($gmail->value->status) && $gmail->value->status ==1)
                            <div class="col-md-2">
                                <a href="{{ route('login.provider',['provider'=>'google']) }}">
                                    <div class="gmail"><img src="{{ asset('uploads/images/gmail.png') }}" width="40px" height="40px" alt="gmail"></div>
                                </a>
                            </div>
                                @endif


                        </div>
                    </div>

                    <!-- End of social Login -->

                    @endif
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                            <i class="ik ik-user"></i>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            <i class="ik ik-lock"></i>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col text-left">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="custom-control-label">&nbsp;Remember Me</span>
                                </label>
                            </div>
                            <div class="col text-right">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                @endif
                            </div>
                        </div>
                        <div class="sign-btn text-center">
                            <button class="btn btn-theme">Sign In</button>
                        </div>
                    </form>
                    @if(Route::has('register'))
                        <div class="register">
                            <p>Don't have an account? <a href="{{route('register')}}">Create an account</a></p>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
