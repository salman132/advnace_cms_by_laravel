@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title container">
                <div class="text-danger">
                    Email Unverified Users
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><img style="border-radius: 50%" width="50px" height="50px" src="{{ asset($user->profile_pic) }}" alt="{{$user->name}}"></td>
                        <td>{{$user->name}}</td>
                        <td>{{!empty($user->role->name) ? $user->role->name : 'Unknown'}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{ route('users.show',$user->id) }}" class="btn-sm btn-success"><span class="ik ik-info"></span></a>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn-sm btn-primary"><span class="ik ik-edit"></span></a>
                            <a href="#" class="btn-sm btn-info" data-toggle="modal" data-target="#emailModal" data-email="{{$user->email}}"><span class="ik ik-mail"></span></a>
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
            {{$users->links()}}
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
                    <form action="{{ route('send.mail') }}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" name="email" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" name="mail_body" id="message-text"></textarea>
                        </div>
                        <div class="form-group container">
                            <div class="text-right">
                                <input type="submit" value="Send message" class="btn btn-primary">
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
        // Social Login Update

        $('#emailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var email = button.data('email');

            var modal = $(this);
            modal.find("input[name='email']").val(email);

        });
    </script>

@endsection

