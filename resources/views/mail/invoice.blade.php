<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Invoice mail</title>
	<link rel="stylesheet" href="">
</head>
<body>

	<h2 style="color:green;">Successfully Order Placed! on our ecommerce</h2><br>
	<strong>Order_id: {{ $order['order_id'] }}</strong><br>
	<strong>Total Amount: {{ $website->currency }}{{ $order['total'] }}</strong><br>
	<strong>Date: {{ $order['date'] }}</strong><br>
	<hr>
	<strong>Name: {{ $order['c_name'] }}</strong><br>
	<strong>Phone: {{ $order['c_phone'] }}</strong><br>
	<strong>Address: {{ $order['c_address'] }}</strong>

</body>
</html>