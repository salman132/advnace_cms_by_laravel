@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header container">
            <div class="card-title text-success">
                Email Template
            </div>
            <div class="container">
                <div class="text-right">
                    <a href="" data-toggle="modal" data-target="#addTemplate" class="btn btn-primary"><span class="ik ik-plus"></span> Add New</a>
                </div>
            </div>

        </div>

        <div class="card-body">
            <div class="py-2">
                <table class="table table-hover">
                    <tr>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                    @foreach($templates as $template)
                    <tr>
                        <td>
                            <div class="text-primary">
                                <h6>{{$template->value->subject ?? null }}</h6>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('using.template',['id'=>$template->id]) }}" class="btn btn-info"><span class="ik ik-mail"></span></a>
                            <a href="{{ route('email.draftEdit',['id'=>$template->id]) }}" class="btn btn-primary"><span class="ik ik-edit-2"></span></a>
                            <a href="#" data-toggle="modal" data-target="#delModal" data-id="{{$template->id}}" data-title="{{$template->value->subject ?? null }}" class="btn btn-danger"><span class="ik ik-trash-2"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>




    <!--  Add Template Modal .... -->
    <div class="modal fade" id="addTemplate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.template-store') }}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Message <span class="text-danger">*</span></label>
                            <textarea name="sms" class="form-control summernote" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group container">
                            <div class="text-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="ADD" class="btn btn-primary">
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <!--  Delete Modal .... -->
    <div class="modal fade" id="delModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Template</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="template_name"></b> Template ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('admin.templateDestroy') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="template_id">
                        <input type="submit" value="DELETE" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control"  name="mail_body" id="message-text" cols="30" rows="10"></textarea>

                        </div>
                        <div class="form-group container">
                            <div class="text-right">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>

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

        $('#delModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find(".template_name").text(title);
                modal.find('input[name=template_id]').val(id);
            });

        // $('#emailModal').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var subject = button.data('subject');
        //     var sms = button.data('sms');
        //     console.log(sms);
        //
        //     var modal = $(this);
        //     modal.find("input[name='subject']").val(subject);
        //     modal.find("#message-text").text(sms);
        //
        //
        // });


    </script>

@endsection



