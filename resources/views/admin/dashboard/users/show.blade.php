@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title container">
                <div class="text-success">
                    {{$user->name}}
                </div>
                <div class="text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-dark"><span class="ik ik-skip-back"></span> Back</a>
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
                    </div>
                </div>

                <!-- ... profile left sidebar ends ... --->
                <div class="col-md-9 col-sm-9 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                User Details
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Join Date</th>
                                    <th>Last Login</th>
                                </tr>
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->isoFormat('MMMM Do YYYY')}}</td>
                                    <td>{{ !empty($last_login) ? $last_login->created_at->diffForHumans() : 'No records' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('custom-js')


@endsection
