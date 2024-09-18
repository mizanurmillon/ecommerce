@extends('layouts.app')
        
@section('content')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@push('css')
@endpush
 <div class="single-profile">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="profile one">
                    <div class="flexwrap">
                        @include('customer.sidebar')
                        <div class="right">
                            <br>
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
                            <div class="order_table">
                                <h2>My All Orders</h2><br>
                                <table class="table table-bordered table_font display" border="1">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Payment Type</th>
                                             <th scope="col">Status</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $row)
                                        <tr>
                                            <td>{{ $row->order_id }}</td>
                                            <td>{{ date('d F , Y'),strtotime($row->date) }}</td>
                                            <td>
                                                @if(Session::has('coupon'))
                                                    {{ $website->currency }}{{ $row->after_discount }}
                                                @else
                                                    {{ $website->currency }}{{ $row->total }}
                                                @endif
                                            </td>
                                            <td>{{ $row->payment_type }}</td>
                                            <td>
                                                @if($row->status==0)
                                                    <span class="badge badge-danger">Order Pending</span>
                                                @elseif($row->status==1)
                                                    <span class="badge badge-info">Order Recieved</span>
                                                @elseif($row->status==2)
                                                    <span class="badge badge-primary">Order Shipped</span>
                                                @elseif($row->status==3)
                                                    <span class="badge badge-success">Order Done</span>
                                                @elseif($row->status==4)
                                                    <span class="badge badge-warning">Order Return</span>
                                                @elseif($row->status==5)
                                                  <span class="badge badge-danger">Order Cancel</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a class="view__btn" title="view" href="{{ route('view.order',$row->id) }}"><i class="ri-eye-line"></i></a>
                                            </td>
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
