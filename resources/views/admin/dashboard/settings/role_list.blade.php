@extends("layouts.admin")

@section("content")

    <div class="card">
        <div class="card-header">
            <div class="card-title container">
                Permission Settings
                <div class="text-right">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#addRole" class="btn btn-primary">Add New Role</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#SL</th>
                    <th>Role</th>
                    <th>Set Roles</th>
                </tr>
                @foreach($roles as $key =>$role)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('admin.perm_set',['id'=>$role->id]) }}" class="btn-sm btn-info"><span class="ik ik-settings"></span></a>
                        </td>

                    </tr>

                    @endforeach

            </table>
        </div>

    </div>



    <!--- Add Modal --->
    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.add-role') }}" method="post" >
                    <div class="modal-body">

                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="role_name" id="" class="form-control" placeholder="Role Name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="ADD" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
