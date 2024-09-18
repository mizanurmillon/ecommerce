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
                                    padding: 20px;
                                }
                                .table tbody tr td{
                                    padding: 20px;
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
                                <h2>All Latest Tickets</h2><br>
                                <a href="{{ route('new.ticket') }}" class="primary-button">Open Ticket</a> <br><br>
                                <table class="table table-bordered table_font display" border="1">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ticket as $row)
                                        <tr>
                                            <td>{{ date('d F , Y'),strtotime($row->date) }}</td>
                                            <td>{{ $row->service }}</td>
                                            <td>{{ $row->subject }}</td>
                                            <td>
                                                @if($row->status==0)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($row->status==1)
                                                    <span class="badge badge-success">Replied</span>
                                                @elseif($row->status==2)
                                                    <span class="badge badge-danger">Closed</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a class="view__btn" href="{{ route('view.ticket',$row->id) }}" style="background-color: #28a745"><i class="ri-eye-line"></i></a>
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
