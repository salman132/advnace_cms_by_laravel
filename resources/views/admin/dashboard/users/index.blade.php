@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title container">
                All Users

                <div class="container text-right">
                    <a href="" data-toggle="modal" data-target="#addModal" class="m-auto btn btn-primary"><span class="ik ik-plus"></span> Add New</a>
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
                        <td {{$user->is_banned ? "class=text-danger" : ""}}>{{$user->name}}</td>
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



    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">User Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="recipient-name" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="user-email" class="col-form-label">Email Address: <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="user-email" placeholder="Email Address" required>
                                </div>

                                <div class="text-danger" id="taken" style="display: none">
                                    This email is already taken
                                </div>
                                <div class="text-success" id="available" style="display: none">
                                    Congrats,This email is available
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="message-password" class="col-form-label">Password: <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="message-password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="confirm-password" class="col-form-label">Confirm Password: <span class="text-danger">*</span></label>
                                    <input type="password" name="confirm_password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
                                    <div class="text-danger py-1" id="msg" style="display: none">
                                        Password does not matching
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Assign Role <span class="text-danger">*</span></label>
                                    <select name="role_id"  class="form-control" required>
                                        <option value="" disabled selected>Select an Option</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" name="profile_pic" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group container">
                            <div class="text-right">
                                <input type="submit" value="Add User" class="btn btn-primary" id="conditional_submit">
                            </div>
                        </div>
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
                    <form action="{{ route('send.mail') }}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="recipient-email" class="col-form-label">Recipient:</label>
                            <input type="text" name="email" class="form-control" id="recipient-email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="subject">
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

        $('input[name="confirm_password"]').focusout(function () {
            var pass1 = $('input[name="password"]').val();
            var pass2 = $(this).val();

            if(pass1 != pass2){
                $('#msg').show();
                $('#conditional_submit').hide();
            }
            else{
                $('#msg').hide();
                $('#conditional_submit').show();
            }
        });

        $('#user-email').focusout(function () {
            var email = $(this).val();

            $.ajax({
                type: "GET",
                url : "{{ url('web_admin/email/availability/check') }}",
                data: {
                    email : email,
                },

                success:function (response) {
                    if(response ==1){
                        $('#taken').show();
                        $('#available').hide();
                        $('#conditional_submit').hide();
                    }
                    if(response ==0){
                        $('#available').show();
                        $('#taken').hide();
                        $('#conditional_submit').show();
                    }

                },
                error:function (xhr) {
                    console.log(xhr)
                }
            })
        });



    </script>

@endsection
