@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header container">
            <div class="card-title text-success">
                Email Design Template
            </div>

        </div>

        <div class="card-body">
            <div class="py-2">
                <form action="{{route('email.design',['id'=>$settings->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Email Sender:</label>
                        <input type="text" name="email"  class="form-control" placeholder="Email" value="{{!empty($settings->email) ? $settings->email : ""}}">
                    </div>
                    <div class="form-group">
                        <label>Email Content</label>
                        <textarea name="email_body" cols="30" rows="10" class="form-control summernote">{!! !empty($settings->email_template) ? $settings->email_template : "" !!}</textarea>
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" value="UPDATE" class="btn btn-primary  active">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@section('custom-js')

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                popover: {
                    image: [],
                    link: [],
                    air: []
                }
            });


        });
    </script>

    @endsection



