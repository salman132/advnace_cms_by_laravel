@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header container">
            <div class="card-title text-success">
                Email Template
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('email.draftUpdate',['id'=>$template->id]) }}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Subject <span class="text-danger">*</span></label>
                    <input type="text" name="subject" class="form-control" value="{{$template->value->subject ?? null }}">
                </div>

                <div class="form-group">
                    <label>Message <span class="text-danger">*</span></label>
                    <textarea name="sms" class="form-control summernote" cols="30" rows="10">{!! $template->value->sms ?? null !!}</textarea>
                </div>

                <div class="form-group container">
                    <div class="text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </div>

            </form>

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



