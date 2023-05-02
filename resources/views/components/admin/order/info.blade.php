<!-- Main content -->
<div class="card-body p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-user"></i> {{!empty($order->user->name) ? $order->user->name : ''}}
                <small class="float-right">Date: {{date("d/m/Y", strtotime($order->created_at))}}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>{{!empty($order->sellerService->name) ? $order->sellerService->name : ''}}</strong><br>
                {{!empty($order->sellerService->address) ? $order->sellerService->address : ''}}<br>
                {{-- Phone: (804) 123-5432<br> --}}
                Email: {{!empty($order->sellerService->email) ? $order->sellerService->email : ''}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{!empty($order->user->name) ? $order->user->name : ''}}</strong><br>
                {{$order->drop_off}}<br>
                Email: {{!empty($order->user->email) ? $order->user->email : ''}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            {{-- <b>Order #{{$order->business_ref_id}}</b><br> --}}
            <b>Status:</b> {{ucfirst($order->order_status)}}<br>
            <b>Order ID:</b> {{$order->business_ref_id}}<br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->userCart as $cart)
                        @foreach ($cart->cartItems()->whereNull('parent_id')->get() as $cartItem)
                        <tr>
                            <td>
                                {{$cartItem->item->name}}
                                @if(!empty($cartItem->childs))
                                    {{-- <br/> {{implode($cartItem->childs, ", ")}} --}}
                                @endif
                            </td>
                            <td>{{$cartItem->item->business_ref_id}}</td>
                            <td>{{$cartItem->item->discountedPrice()}}</td>
                            <td>{{$cartItem->quantity}}</td>
                            <td>{{$cartItem->description}}</td>
                            <td>{{$cartItem->price}}</td>
                            {{-- <td>El snort testosterone trophy driving gloves handsome</td> --}}
                            {{-- <td>$64.50</td> --}}
                        </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td class="float-right"><b>Total</b></td>
                        <td>{{$order->total_price}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
            <p class="lead">Payment Methods:</p>
            <img src="https://adminlte.io/themes/v3/dist/img/credit/visa.png" alt="Visa">
            <img src="https://adminlte.io/themes/v3/dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="https://adminlte.io/themes/v3/dist/img/credit/american-express.png" alt="American Express">
            <img src="https://adminlte.io/themes/v3/dist/img/credit/paypal2.png" alt="Paypal">

            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">Amount Due 2/22/2014</p>

            <div class="table-responsive">
                <table class="table">
                    {{-- <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{$order->userCart[0]->cartItems->sum('price')}}</td>
                    </tr> --}}
                    <tr>
                        <th>Tax (9.3%)</th>
                        <td>{{$order->tax}}</td>
                    </tr>
                    <tr>
                        <th>Shipping:</th>
                        <td>{{$order->delivery_charges}}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>{{$order->total_price}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    {{-- <div class="row no-print">
        <div class="col-12">
            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                    class="fas fa-print"></i> Print</a>
            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                Payment
            </button>
            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generate PDF
            </button>
        </div>
    </div> --}}
</div>
<!-- /.invoice -->