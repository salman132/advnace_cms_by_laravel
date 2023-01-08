<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config::get('site_name') }}</title>
</head>
<body>

    @php
    if(isset($name)){
      $data = str_replace('{{name}}',$name,email_template());
      }
    if(isset($sms)){
      $data = str_replace('{{sms}}',$sms,$data);
      $data = str_replace("{{date('Y')}}",date('Y'),$data);
    }
    @endphp
    {!! $data !!}
</body>
</html>
