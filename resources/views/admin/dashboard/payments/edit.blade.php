@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="container card-title">
                Payment Gateway : <span class="text-info">{{$payment->gateway_name}}</span>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <form action="{{ route('payments.update',$payment->id) }}" method="post">
                        @method('PUT')
                        {{csrf_field()}}
                        @if(strtolower($payment->gateway_name) != 'cash on delivery')
                        <div class="form-group">
                            <label>{{ !empty($payment->gateway_name) ? $payment->gateway_name: "" }} Account Mail <span class="text-danger">*</span></label>
                            <input type="text" name="account"  class="form-control" value="{{ !empty($payment->account_name) ? decrypt($payment->account_name) : "" }}" required>
                        </div>

                        <div class="form-group">
                            <label>Client ID <span class="text-danger">*</span></label>
                            <textarea name="client_id" cols="30" rows="10" class="form-control" required>{{ !empty($payment->client_id) ? decrypt($payment->client_id) : "" }}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Client Secret <span class="text-danger">*</span></label>
                            <textarea name="client_secret" cols="30" rows="10" class="form-control" required>{{ !empty($payment->client_secret) ? decrypt($payment->client_secret) : "" }}</textarea>

                        </div>
                        @endif
                        <div class="form-group">
                            <select name="status"  class="form-control">
                                <option value="1" {{$payment->status ==1 ? "selected" : ""}}>Active</option>
                                <option value="0" {{$payment->status == 0 ? "selected" : ""}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="SAVE" class="btn btn-primary">
                        </div>

                    </form>
                </div>

                <div class="col-md-6 col-12">
                    <div class="py-3">
                        <ul>
                            <li class="text-info" style="font-size: 13px;">We care about your security.</li>
                            <li class="text-success" style="font-size: 13px;">Your Payment info will be encrypted in our database.</li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>


    </div>


@endsection
