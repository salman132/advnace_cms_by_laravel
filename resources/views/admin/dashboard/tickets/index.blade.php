@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="container card-title">
                Ticket Supports
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Ticket Owner</th>
                    <th>Ticket No</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Change Status</th>
                    <th>Action</th>
                </tr>
                @foreach($tickets as $ticket)
                    <tr>
                        <td><a href="{{ route('users.show',!empty($ticket->user->id) ? $ticket->user->id : '#') }}" class="text-info">{{ !empty($ticket->user->name) ? $ticket->user->name : 'Not Found' }}</a></td>
                        <td>{{ $ticket->ticket }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>
                            @if($ticket->status ==0)
                                <span class="justify-content-center badge badge-pill badge-danger">Pending</span>
                            @elseif($ticket->status ==1)
                                <span class="justify-content-center badge badge-pill badge-primary">Open</span>
                                <p style="font-size: 11px" class="text-info">By: {{ !empty($ticket->find_user($ticket->opened_by)->name) ? $ticket->find_user($ticket->opened_by)->name: 'Not Found' }}</p>
                            @elseif($ticket->status ==2)
                                <span class="justify-content-center badge badge-pill badge-success">Closed</span>
                                <p style="font-size: 11px" class="text-info">By: {{ !empty($ticket->find_user($ticket->opened_by)->name) ? $ticket->find_user($ticket->opened_by)->name: 'Not Found' }}</p>
                            @endif
                        </td>
                        <td>{{ $ticket->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-info" data-tooltip="tooltip" title="Mark As Open" data-toggle="modal" data-target="#openModal" data-id="{{ $ticket->id }}" data-title="{{ $ticket->ticket }}"> <span class="ik ik-book-open"></span></a>
                            <a href="javascript:void(0)" class="btn btn-success" data-tooltip="tooltip" title="Mark As Closed" data-toggle="modal" data-target="#closeModal" data-id="{{ $ticket->id }}" data-title="{{ $ticket->ticket }}"> <span class="ik ik-lock"></span></a>
                        </td>
                        <td>
                            <a href="{{ route('admin.support_show',['id'=>$ticket->id]) }}" class="btn btn-primary" data-tooltip="tooltip" title="Show"><span class="ik ik-fast-forward"></span></a>
                            <a href="javascript:void(0)" class="btn btn-danger" data-tooltip="tooltip" title="Delete" data-toggle="modal" data-target="#delModal" data-id="{{ $ticket->id }}" data-title="{{ $ticket->ticket }}"><span class="ik ik-trash"></span></a>

                        </td>
                    </tr>

                @endforeach
                {{ $tickets->links() }}
            </table>
        </div>
    </div>


    <!--  Delete Modal .... -->
    <div class="modal fade" id="delModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Support Ticket</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="ticket_name"></b> Ticket ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('admin.support_delete') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="ticket_id">
                        <input type="submit" value="DELETE" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--  Open Modal .... -->
    <div class="modal fade" id="openModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Open Support Ticket</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to Open this <b class="ticket_name"></b> Ticket ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('admin.support.open') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="ticket_id">
                        <input type="submit" value="OPEN" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--  Close Modal .... -->
    <div class="modal fade" id="closeModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Close Support Ticket</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to Close this <b class="ticket_name"></b> Ticket ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('admin.support.closed') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="ticket_id">
                        <input type="submit" value="YES" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('custom-js')

    <script>
        $('#delModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var id = button.data('id');
            var title = button.data('title');

            var modal = $(this)

            modal.find(".ticket_name").text(title);
            modal.find('input[name=ticket_id]').val(id);
        });




        $('#openModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var id = button.data('id');
            var title = button.data('title');

            var modal = $(this)

            modal.find(".ticket_name").text(title);
            modal.find('input[name=ticket_id]').val(id);
        });


        $('#closeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var id = button.data('id');
            var title = button.data('title');

            var modal = $(this)

            modal.find(".ticket_name").text(title);
            modal.find('input[name=ticket_id]').val(id);
        });
    </script>

@endsection



