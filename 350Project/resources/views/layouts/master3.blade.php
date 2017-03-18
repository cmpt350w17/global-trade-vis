<!DOCTYPE html>
<html>
<style>
#hello {
	width: 250px;

	margin: -5px;
	margin-top: -5px;
}
.custom-select {
   width: 175px;
	margin: 5px;
}
#slider {
   margin-top: 20px;
	width: 175px;
}
#sidebar {
	margin-top: -19px;
	width:15%;
}
div.test {
	position: absolute;
	top: -200px;
	margin: 300px;
}
</style>
<head>
	<title>Global Trade Vis</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
</head>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header"></div>
		<ul class="nav navbar-nav">
			<li> <a href="/">Map View</a></li>
         <li><a href="bars">Bar view</a></li>
			<li><a href="lines">Line view</a></li>
         <li><a href="disc">Disc view</a></li>
		</ul>
	</div>
</nav>
<body>
 @yield('content')
<div class="test">
	@yield('stuff')
</div>
</body>
</html>
