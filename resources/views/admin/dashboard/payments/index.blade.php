@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="container card-title">
                Payment Gateways
                <ul>
                    <li class="text-info" style="font-size: 13px;">We care about your security.</li>
                    <li class="text-success" style="font-size: 13px;">Your Payment info will be encrypted in our database.</li>

                </ul>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Logo</th>
                    <th>Gateway</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($payments as $payment)
                    <tr>
                        <td><img src="{{ asset($payment->logo) }}" alt="{{$payment->gateway_name}}" width="120px" height="110px"></td>
                        <td><div class="text-primary font-weight-bold">{{$payment->gateway_name}}</div></td>
                        <td>@if($payment->status ==1) <div class="text-success"><span class="ik ik-star-on"></span> Active</div>  @else <div class="text-danger"><span class="ik ik-stop-circle"></span> Inactive</div> @endif</td>
                        <td>
                            <a href="{{ route('payments.edit',$payment->id) }}" class="btn btn-primary"><span class="ik ik-edit"></span> Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


@endsection
