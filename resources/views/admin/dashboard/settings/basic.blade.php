@extends("layouts.admin")

@section("content")

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Basic Settings

            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                @if(!empty($settings))
                <form action="{{route('settings.update',$settings->id)}}" method="post"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="row">

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Site Title</h6></label>
                            <div class="form-group">
                                <input type="text" name="site_title"  class="form-control py-3" placeholder="Website Title" value="{{$settings->site_title}}">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Currency</h6></label>
                            <div class="form-group">
                                <input type="text" name="currency"  class="form-control py-3" placeholder="For EX, USD" value="{{$settings->currency}}">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Currency Symbol</h6></label>
                            <div class="form-group">
                                <input type="text" name="currency_symbol"  class="form-control py-3" placeholder="For EX,$" value="{{$settings->currency_symbol}}">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Email Verification</h6></label>
                            <div class="form-group">
                                @if($settings->ev ==1)
                                <input type="checkbox" name="email_verification" checked data-toggle="toggle" class="form-control py-3">
                                    @else
                                    <input type="checkbox" name="email_verification"  data-toggle="toggle" class="form-control py-3">
                                    @endif
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Email Notification</h6></label>
                            <div class="form-group">
                                @if($settings->en == 1)
                                <input type="checkbox" name="email_notify" checked data-toggle="toggle" class="form-control py-3">
                                    @else
                                 <input type="checkbox" name="email_notify"  data-toggle="toggle" class="form-control py-3">
                                    @endif
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>User Registration</h6></label>
                            <div class="form-group">
                                @if($settings->user_register ==1)
                                <input type="checkbox" name="user_register" checked data-toggle="toggle" class="form-control py-3">
                                    @else
                                <input type="checkbox" name="user_register" data-toggle="toggle" class="form-control py-3">
                                    @endif

                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Alert System</h6></label>
                            <div class="form-group">
                                <select name="alertui" id="" class="form-control">

                                    <option value="1" @if($settings->alert_system ==1) selected @endif>Toastr Alert</option>
                                    <option value="2" @if($settings->alert_system ==2) selected @endif>IZI Toast Alert</option>
                                    <option value="3" @if($settings->alert_system ==3) selected @endif>No Alert</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Alert System</h6></label>
                            <div class="form-group">
                                <select name="timezone" class="form-control selectpicker">
                                    @foreach($timezones as $timezone)

                                        <option value="{{$timezone->id}}" @if($timezone->id == $settings->timezone_id) selected @endif>{{$timezone->timezone}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Site Base Background Color</h6></label>
                            <div class="form-group">
                                <input type="text" name="bg_color" class="form-control" placeholder="Background Color" value="{{$settings->bg_color}}" style="border: 1px solid {!! $settings->bg_color !!} ">

                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <label><h6>Site Base Background Image</h6></label>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control py-3" id="backPic">
                            </div>
                            @if(!empty($settings->bg_image))
                                <img src="{{asset($settings->bg_image)}}" class="rounded" alt="" height="auto" width="400px" id="backPicPlace">
                            @endif
                        </div>

                    </div>


                    <div class="text-right">
                        <input type="submit" value="SAVE" class="btn btn-primary active">
                    </div>
                </form>
                    @endif
            </div>


        </div>

    </div>


    @endsection


@section('custom-js')
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#backPicPlace').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#backPic").change(function() {
                readURL(this);
            });
        })
    </script>

    @endsection
