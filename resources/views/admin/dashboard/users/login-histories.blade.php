@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header container">
            <div class="card-title text-left">
                Login Histories
            </div>
            <div class="text-right container">
                <a href="{{ url()->previous() }}" class="btn btn-dark"><span class="ik ik-rewind"></span> Back</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>IP</th>
                    <th>Location</th>
                    <th>Device</th>
                    <th>Login Time</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
               @if(count($login_histories)>0)

                   @foreach($login_histories as $history)
                       <tr>
                           <td>{{!empty($history->user->name) ? $history->user->name : "Not Found"}}</td>
                           <td>{{$history->ip_address}}</td>
                           <td>{{$history->country}}</td>
                           <td>
                               <p class="clearfix">
                                   <span class="float-left font-weight-bold">Browser: </span>&nbsp;
                                   <span class="justify-content-center text-primary">{{ $history->browser }}</span>
                               </p>
                               <p class="clearfix">
                                   <span class="float-left font-weight-bold">OS: </span>&nbsp;
                                   <span class="justify-content-center text-primary">{{ $history->os }}</span>
                               </p>
                           </td>
                           <td>
                               <p class="clearfix">
                                   <span class="float-left font-weight-bold">Date: </span>&nbsp;
                                   <span class="justify-content-center text-dark">{{$history->created_at->toDateTimeString()}}</span>
                               </p>
                               <p class="clearfix">
                                   <span class="float-left font-weight-bold">Time: </span>&nbsp;
                                   <span class="justify-content-center text-dark">{{$history->created_at->diffForHumans()}} </span>
                               </p>
                           </td>
                           <td>
                               <a href="" data-toggle="modal" data-target="#delModal" data-title="{{$history->ip_address}}" data-id="{{$history->id}}" class="btn btn-danger"><span class="ik ik-trash"></span></a>
                           </td>
                       </tr>

                       @endforeach

                   @else
                   <tr>
                       <td colspan="5" rowspan="5" class="text-danger text-center">No Data Found</td>
                   </tr>

                   @endif


                </tbody>
            </table>

        </div>
    </div>





    <!--  Delete Modal .... -->
    <div class="modal fade" id="delModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Login History</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="history_name"></b> Product ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('login-history.destroy') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="history_id">
                        <input type="submit" value="DELETE" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('custom-js')

    <script>
        $(document).ready(function () {

            $('#delModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find(".history_name").text(title);
                modal.find('input[name=history_id]').val(id);
            });


        });
    </script>

@endsection
