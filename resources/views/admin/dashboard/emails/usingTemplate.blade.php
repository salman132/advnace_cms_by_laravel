@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title container">
                Send Mail To All
            </div>
            <div class="container">
                <div class="text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-dark"><span class="ik ik-rewind"> Back</span></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('sendmail.all') }}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Recipient: <span class="text-danger">*</span></label>
                            <select name="audience" class="form-control">
                                <option value="" disabled selected>Select Users</option>
                                <option value="1">Active Users</option>
                                <option value="2">Inactive Users</option>
                                <option value="3">Banned Users</option>
                                <option value="4">All Users</option>
                                <option value="5">Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none" id="receiver">
                        <div class="form-group">
                            <label>User Mail Address: <span class="text-danger">*</span></label>
                            <input type="email" name="receiver" class="form-control" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Subject <span class="text-danger">*</span></label>
                    <input type="text" name="subject" placeholder="Subject" class="form-control" value="{{ $template->value->subject }}">
                </div>
                <div class="form-group">
                    <label>Mail Body <span class="text-danger">*</span></label>
                    <textarea name="mail_body" class="form-control summernote" cols="30" rows="10">{!! $template->value->sms !!}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Send" class="btn btn-primary form-control active">
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
        $('[name="audience"]').on('change',function () {
            var id = $(this).val();
            if(id ==5){
                $('#receiver').show();
            }
            else{
                $('#receiver').hide();
            }
        })

    </script>
@endsection
