<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Contect mail</title>
	<link rel="stylesheet" href="">
</head>
<body>

	<h1>Your have received a contact mail. </h1>

	<strong>Name: {{ $mailData['name'] }}</strong><br>
	<strong>Phone: {{ $mailData['phone'] }}</strong><br>
	<strong>Email: {{ $mailData['email'] }}</strong><br>
	<strong>Subject: {{ $mailData['subject'] }}</strong><br>
	<strong>Message: {{ $mailData['message'] }}</strong><br>

</body>
</html>