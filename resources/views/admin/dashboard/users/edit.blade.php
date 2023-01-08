@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
               <div class="text-success">
                   {{$user->name}}
               </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
               <!-- ... profile left sidebar ... --->
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="img-area">
                        <img width="220px" height="220px" style="border-radius: 50%" src="{{ asset($user->profile_pic) }}" alt="{{ $user->name }}" class="img-fluid">

                    </div>
                    <hr>
                    <div class="description-area">
                       <p class="clearfix">
                           <span class="float-left font-weight-bold">Name: </span>&nbsp;
                           <span class="float-right justify-content-center text-primary">{{$user->name}}</span>
                       </p>

                        <p class="clearfix">
                            <span class="float-left font-weight-bold">Email: </span>&nbsp;
                            <span class="float-right justify-content-center text-primary">{{$user->email}}</span>
                        </p>

                        <p class="clearfix">
                            <span class="float-left font-weight-bold">Role: </span>&nbsp;
                            <span class="float-right justify-content-center text-primary">{{!empty($user->role->name) ? $user->role->name : "Unknown"}}</span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left font-weight-bold">Status: </span>&nbsp;
                            @if($user->is_banned)
                            <span class="float-right justify-content-center badge badge-pill badge-danger">Banned</span>
                                @else
                            <span class="float-right justify-content-center badge badge-pill badge-success">Active</span>
                            @endif
                        </p>

                        <p class="clearfix">
                            <span class="float-left font-weight-bold">Login History: </span>&nbsp;
                            <span class="float-right justify-content-center text-primary"><a href="{{ route('login-history.show',$user->id) }}" class="text-info ik ik-info"> Login History</a></span>
                        </p>
                        @if(Auth::user()->is_admin || Auth::user()->role_id ==1)
                                @if($user->is_banned ==1)
                                    <p class="clearfix">
                                        <span class="float-left font-weight-bold">Banned By:</span>
                                        <span class="float-right justify-content-center"><a href="{{ route('users.show',$user->find_user($user->banned_by)->id) }}" class="text-success">{{$user->find_user($user->banned_by)->name}}</a></span>
                                    </p>
                                @endif
                                @if($user->updated_by !=NULL)
                                    <p class="clearfix">
                                        <span class="float-left font-weight-bold">Updated By:</span>
                                         <span class="float-right justify-content-center"><a href="{{ route('users.show',$user->find_user($user->updated_by)->id) }}" class="text-info">{{$user->find_user($user->updated_by)->name}}</a></span>
                                    </p>
                                @endif

                        @endif
                    </div>
                </div>

                <!-- ... profile left sidebar ends ... --->
                <div class="col-md-9 col-sm-9 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Update Info
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update',$user->id) }}" method="post">
                                {{csrf_field()}}
                                @method("PUT")
                                <div class="form-group">
                                    <label>Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email: <span class="text-danger">*</span></label>
                                    <input type="text" name="email"  value="{{$user->email}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7 col-12">
                                                <label>User Role</label>
                                                <select name="role_id" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}" {{$role->id == $user->role_id ? "selected" : ""}}>{{$role->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-5 col-sm-5 col-12">
                                                <label>Status: <span class="text-danger">*</span></label>
                                                @if($user->is_banned)
                                                    <input type="checkbox" name="status"  data-toggle="toggle" class="form-control py-3">
                                                @else

                                                    <input type="checkbox" name="status" checked  data-toggle="toggle" class="form-control py-3">
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Save Changes" class="btn btn-primary form-control active">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

