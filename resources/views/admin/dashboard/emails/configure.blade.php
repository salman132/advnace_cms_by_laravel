@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header container">
            <div class="card-title text-danger">
                Email Sending Method Configure
            </div>

        </div>

        <div class="card-body">


            <!--... form area ... -->
            <div class="form-area">
                <form action="{{ route('email-manager.update',$settings->id) }}" method="post" >
                    {{csrf_field()}}
                    @method("PUT")
                    <div class="selection-area">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Select a Email System</label>
                                    <select name="email_system" class="form-control" id="email_system">
                                        <option disabled selected>Select an Item</option>
                                        <option value="1" {{$settings->email_config ==1 ? "selected" : ""}}>PHP Mail</option>
                                        <option value="2" {{$settings->email_config ==2 ? "selected" : ""}}>SMTP Mail</option>
                                        <option value="3" {{$settings->email_config ==3 ? "selected" : ""}}>Mailgun API Service</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SMTP MAIL -->
                    <div class="row" id="smtp" style="display: none;">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Host <span class="text-danger">*</span></label>
                                <input type="text" name="host" class="form-control" placeholder="User Name" value="{{!empty($settings->email_settings->host) ? $settings->email_settings->host : ""}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Port No <span class="text-danger">*</span></label>
                                <input type="text" name="port_no" class="form-control" placeholder="Port Number" value="{{!empty($settings->email_settings->port_no) ? $settings->email_settings->port_no : ""}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" placeholder="User Name" value="{{!empty($settings->email_settings->username) ? $settings->email_settings->username : ""}}">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>App Password <span class="text-danger">*</span></label>
                                <input type="text" name="password" class="form-control" placeholder="Your APP Password" value="{{!empty($settings->email_settings->password) ? $settings->email_settings->password : ""}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Driver <span class="text-danger">*</span></label>
                                <input type="text" name="driver" class="form-control" placeholder="e.g: smtp" value="{{!empty($settings->email_settings->driver) ? $settings->email_settings->driver : ""}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Encryption <span class="text-danger">*</span></label>
                                <input type="text" name="encryption" class="form-control" placeholder="e.g: ssl,tls" value="{{!empty($settings->email_settings->encryption) ? $settings->email_settings->encryption : ""}}">
                            </div>
                        </div>



                    </div>

                    <!-- PHP MAIL -->
                    <div class="row" id="php" style="display: none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mail Host Name <span class="text-danger">*</span></label>
                                <input type="text" name="php_mail_name" class="form-control" placeholder="e.g noreply@domain.com" value="{{$settings->email}}">
                            </div>
                        </div>


                    </div>

                    <!-- MAIL API -->
                    <div class="row" id="api" style="display: none;">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Domain <span class="text-danger">*</span></label>
                                <input type="text" name="api_domain" class="form-control" placeholder="your-mailgun-domain" value="{{$email_api->value->api_domain}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Secret <span class="text-danger">*</span></label>
                                <input type="text" name="api_secret" class="form-control" placeholder="your-mailgun-secret" value="{{$email_api->value->api_secret}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Endpoint</label>
                                <input type="text" name="api_endpoint" class="form-control" placeholder="api.eu.mailgun.net" value="{{$email_api->value->api_endpoint}}">
                            </div>
                        </div>


                    </div>
                    <div class="form-group container">
                        <div class="text-right">
                            <input type="submit" value="UPDATE" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


@endsection


@section('custom-js')

    <script>
        $(document).ready(function () {

            var email_system = "{{$settings->email_config}}";

            var smtp = $('#smtp');
            var php = $('#php');
            var api = $('#api');

            if(email_system == 1) {

                php.show();
                smtp.hide();
                api.hide();
            }
            if(email_system == 2) {
                smtp.show();
                php.hide();
                api.hide();
            }
            if(email_system ==3){
                smtp.hide();
                php.hide();
                api.show();
            }
        });

        $('#email_system').on('change',function () {
              var email_system = $(this).val();
              var smtp = $('#smtp');
              var php = $('#php');
            var api = $('#api');


              if(email_system == 1){
                  smtp.hide();
                  api.hide();
                  php.show();
              }
              if(email_system == 2){
                  smtp.show();
                  php.hide();
                  api.hide();
              }
                if(email_system ==3){
                    smtp.hide();
                    php.hide();
                    api.show();
                }
        });

    </script>

@endsection
