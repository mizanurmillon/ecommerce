@extends('layouts.app')
        
@section('content')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@push('css')
<style type="text/css">
    .table thead tr th{
        padding: 30px;
    }
    .table tbody tr td{
        padding: 25px;
    }
    .badge {
        color: #fff;
        display: inline-block;
        padding: .20em .5em;
        font-size: 80%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .badge-danger {
        background-color: #dc3545;
    }
    .badge-info {
        background-color: #17a2b8;
    }
    .badge-primary{
        background-color: #007bff;
    }
    .badge-success{
        background-color: #28a745;
    }
    .badge-warning{
        background-color: #ffc107;
    }
</style>
@endpush
 <div class="single-profile">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="profile one">
                    <div class="flexwrap">
                        @include('customer.sidebar')
                        <div class="right">
                            <div>
                                <h3>Order Detalis:</h3><hr>
                                <strong>User Name:</strong> {{ $order->c_name }} <br>
                                <strong>Phone:</strong> {{ $order->c_phone }}<br>
                                <strong>Email:</strong> {{ $order->c_email }}<br>
                                <strong>Address:</strong> {{ $order->c_address }}<br>
                                <strong>orderId:</strong> {{ $order->order_id }}<br>
                                <strong>Status:
                                    @if($order->status==0)
                                        <span class="badge badge-danger">Order Pending</span>
                                    @elseif($order->status==1)
                                        <span class="badge badge-info">Order Recieved</span>
                                    @elseif($order->status==2)
                                        <span class="badge badge-primary">Order Shipped</span>
                                    @elseif($order->status==3)
                                        <span class="badge badge-success">Order Done</span>
                                    @elseif($order->status==4)
                                        <span class="badge badge-warning">Order Return</span>
                                    @elseif($order->status==5)
                                      <span class="badge badge-danger">Order Cancel</span>
                                    @endif
                                </strong><br>
                                <strong>Date:</strong> {{ date('d F Y'),strtotime($order->date) }}<br>
                                <strong>Subtotal:</strong> {{ $website->currency }}{{ $order->subtotal }}<br>
                                <strong>Total:</strong> 
                                    @if(Session::has('coupon'))
                                        {{ $website->currency }}{{ $order->after_discount }}
                                    @else
                                        {{ $website->currency }}{{ $order->total }}
                                    @endif
                                <br>
                            </div>
                            <br>
                            <div class="order_table">
                                <h2>My Orders</h2><br>
                                <table class="table table-bordered table_font display" border="1">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Subtotal Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_details as $key=>$row)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $row->product_name }}</td>
                                            <td>{{ $row->color }}</td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>{{ $row->single_price }}{{ $website->currency }}</td>
                                            <td>{{ $row->subtotal_price }}{{ $website->currency }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div><br>
<br>
<br>
@push('js')
@endpush
@endsection
