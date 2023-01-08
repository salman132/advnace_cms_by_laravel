@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="container card-title">
                Cancelled Orders
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Change Status</th>
                    <th>Created At</th>
                    <th>Action</th>

                </tr>

                @if(count($cancelled_order) >0)

                    @foreach($cancelled_order as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    @foreach($order->product as $product)
                                        <li class="list-group-item">
                                            @if(!empty($product->product_slug))
                                                <a href="{{ route('products.edit',$product->product_slug) }}" target="_blank" class="text-info">
                                                    {{ !empty($product->product_name) ? $product->product_name : "" }}
                                                </a>
                                            @endif
                                        </li>

                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $order->quantity }}</td>
                            <td class="text-info">{{ $order->total_price }} {{  Config::get('CURRENCY_SYMBOL') }}</td>

                            <td>{{ !empty($order->payment_method->gateway_name) ? $order->payment_method->gateway_name : "" }}</td>
                            <td>
                                @if($order->is_accepted ==1)
                                    <span class='text-success'>Completed</span>
                                @elseif($order->is_accepted === null)
                                    <span class='text-info'>Waiting for Approval</span>
                                @else
                                    <span class='text-danger'>Cancelled</span>

                                @endif
                            </td>
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="#" class="btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $order->id }}" data-title="{{ $order->order_number }}"><span class="ik ik-trash-2"></span></a>
                            </td>

                        </tr>

                    @endforeach

                @else
                    <tr><td rowspan="10">No Order Found</td></tr>
                @endif
                {{ $cancelled_order->links() }}

            </table>
        </div>
    </div>




    <!--  Reject Modal .... -->
    <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Cancel Order</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="order_name"></b> Order ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('admin.order_destroy') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="order_id">
                        <input type="submit" value="Yes" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('custom-js')

    <script>
        $(document).ready(function () {

            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this);
                console.log(title);

                modal.find(".order_name").text(title);
                modal.find('input[name=order_id]').val(id);
            });


        });

    </script>

@endsection



