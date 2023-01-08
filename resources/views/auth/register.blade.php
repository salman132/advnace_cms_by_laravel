
@extends('layouts.admin')

@section('content')

    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url({{ asset(config('BASE_BACKGROUND_IMAGE')) }})">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="{{url('/')}}"><img src="{{asset('src/img/brand.svg')}}" alt=""></a>
                        </div>

                        <h3>New to: {{ Config::get('SITE_TITLE') }} ?</h3>

                        <p>Join us today! It takes only few steps</p>
                        @if(Config::get('USER_REGISTER') ==1)
                        <!-- Social Login -->
                        <div class="py-2">
                            <div class="text-info">You can register using </div>
                            <div class="row">
                                @if($facebook->value->status ==1)
                                <div class="col-md-2">
                                    <a href="{{ route('login.provider',['provider'=>'facebook']) }}" id="facebook">
                                        <div class="facebook"><img src="{{ asset('uploads/images/facebook.png') }}" width="40px" height="40px" alt="facebook"></div>
                                    </a>
                                </div>
                                @endif

                                @if($gmail->value->status ==1)

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


                        <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="ik ik-user"></i>
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="ik ik-mail"></i>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="ik ik-lock"></i>
                            </div>
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                <i class="ik ik-eye-off"></i>
                            </div>
                            <div class="form-group">
                                <label>Profile Picture</label><br>
                                <input type="file" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror" required>

                                @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12 text-left">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                        <span class="custom-control-label">&nbsp;I Accept <a href="#">Terms and Conditions</a></span>
                                    </label>
                                </div>

                            </div>
                            <div class="sign-btn text-center">
                                <button class="btn btn-theme custom-hide">Create Account</button>
                            </div>
                        </form>


                        <div class="register">
                            <p>Already have an account? <a href="{{route('login')}}">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom-js')

    <script>
        $(document).ready(function () {
            var submit = $(".custom-hide").attr('disabled',true);

           $('input[type="checkbox"]').click(function () {

               if($(this).prop("checked") == true){
                   $(".custom-hide").attr('disabled',false)
               }
               else if($(this).prop("checked") == false){
                   $(".custom-hide").attr('disabled',true)
               }
           });




        });
    </script>

    @endsection
