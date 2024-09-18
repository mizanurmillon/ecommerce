<div class="print_area">
	<div class="heading_area">
		<div class="row">
			<div class="col-md-8">
				<div class="company_name text-center">
					<h3><b>Laravel Ecommerce </b></h3>
					<h6>All Order details</h6>
				</div>
			</div>
		</div>
	</div>
	<table class="table-bordered">
		<thead>
			<tr>
				<th>Sl</th>
	            <th>Name</th>
	            <th>Phone</th>
	            <th>Email</th>
	            <th>Subtotal ({{ $website->currency }})</th>
	            <th>Total ({{ $website->currency }})</th>
	            <th>Payment Type</th>
	            <th>Date</th>
	            <th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($order as $key=>$row)
			<tr>
				<td><h6 class="m-0 p-0">{{ ++$key }}</h6></td>
				<td><h6 class="m-0 p-0">{{ $row->c_name }}</h6></td>
				<td><h6 class="m-0 p-0">{{ $row->c_phone }}</h6></td>
				<td><h6 class="m-0 p-0">{{ $row->c_email }}></h6></td>
				<td><h6 class="m-0 p-0">{{ $row->subtotal }}</h6></td>
				<td><h6 class="m-0 p-0">{{ $row->total }}</h6></td>
				<td><h6 class="m-0 p-0">{{ $row->payment_type }}</h6></td>
				<td><h6 class="m-0 p-0">{{ $row->date }}</h6></td>
				<td><h6 class="m-0 p-0">
					@if ($row->status==0) 
                        Pending Order
                    @elseif($row->status==1)
                       Recieved Order
                    @elseif($row->status==2)
                        Shipped Order
                    @elseif($row->status==3)
                        Completed Order
                    @elseif($row->status==4)
                        Return Order
                    @elseif($row->status==5)
                        Cancel Order
                    @else
                    @endif
				</h6></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>