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

            <div class="links">
                <div id="paypal-button"></div>
            </div>


            <form action="{{ route('stripe.pay') }}" method="post">
                {{csrf_field()}}
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_JslrmFqV6LCuWfrjG6nrWgay"
                    data-amount="1000"
                    data-name="Demo Site"
                    data-description="Example charge"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto">
                </script>
            </form>

        </div>
    </div>


@endsection

@section('custom-js')

    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
                size: 'large',
                color: 'gold',
                shape: 'pill',
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('{{ route('paypal.pay') }}')
                    .then(function(res) {
                        // 3. Return res.id from the response
                        // console.log(res);
                        return res.id;
                    });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('{{ route('paypal.execute') }}', {
                    paymentID: data.paymentID,
                    payerID:   data.payerID,
                })
                    .then(function(res) {
                        console.log(res);
                        alert('PAYMENT WENT THROUGH!!');
                        // 3. Show the buyer a confirmation message.
                    });
            }
        }, '#paypal-button');
    </script>


@endsection
