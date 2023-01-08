@extends("layouts.admin")

@section("content")


    <div class="card">
        <div class="card-header">
            <div class="card-title container">
                Permission Settings
                <div>Role: <span class="text-info">{{ $role_name->name }}</span> </div>

                <div class="text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-dark"><span class="ik ik-repeat"></span>Back</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{ route('admin.perm_update',['role'=>$role]) }}" method="post">
                    {{ csrf_field() }}

                    <!-- Put 4 checkbox max inside a column --->
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="dash" value="1" @if(in_array(1,$permission)) checked @endif>
                                <label for="dash" class="form-check-label">Dashboard</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="cat" value="2" @if(in_array(2,$permission)) checked @endif>
                                <label for="cat" class="form-check-label">Category</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="tag" value="3" @if(in_array(3,$permission)) checked @endif>
                                <label for="tag" class="form-check-label">Tags</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="products" value="4" @if(in_array(4,$permission)) checked @endif>
                                <label for="products" class="form-check-label">Products</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="users" value="5" @if(in_array(5,$permission)) checked @endif>
                                <label for="users" class="form-check-label">Users</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="loginHistory" value="6" @if(in_array(6,$permission)) checked @endif>
                                <label for="loginHistory" class="form-check-label">Login History</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="mail" value="7" @if(in_array(7,$permission)) checked @endif>
                                <label for="mail" class="form-check-label">Email</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="support" value="8" @if(in_array(8,$permission)) checked @endif>
                                <label for="support" class="form-check-label">Support Ticket</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="subscriber" value="9" @if(in_array(9,$permission)) checked @endif>
                                <label for="subscriber" class="form-check-label">Subscriber</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="payment" value="10" @if(in_array(10,$permission)) checked @endif>
                                <label for="payment" class="form-check-label">Payment Gateway</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="order" value="11" @if(in_array(11,$permission)) checked @endif>
                                <label for="order" class="form-check-label">Order</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="plugin" value="12" @if(in_array(12,$permission)) checked @endif>
                                <label for="plugin" class="form-check-label">Plugin</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="front" value="13" @if(in_array(13,$permission)) checked @endif>
                                <label for="front" class="form-check-label">Frontend Manager</label>

                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-6 py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[]" id="settings" value="14" @if(in_array(14,$permission)) checked @endif>
                                <label for="settings" class="form-check-label">Settings</label>

                            </div>
                        </div>


                    </div>

                    <div class="py-5">
                        <div class="container">
                            <div class="text-right">
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>




                </form>
            </div>

        </div>

    </div>


@endsection
