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
.sidebar {
	margin-top: -20px;
	width:15%;
}



html, body {

	font: 12px Arial;


}
path {
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}
.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}
.legend {
	font-size: 15px
}

.slidez {
	position: relative;
	left: 500px;
}
.col-md-6 {
	left: 300px;
	width: 300px;
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
		<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crossfilter/1.3.12/crossfilter.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/dc/2.0.0-beta.29/dc.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dc/2.0.0-beta.29/dc.css" media="screen"/>
		<script src="//cdnjs.cloudflare.com/ajax/libs/d3-legend/1.1.0/d3-legend.js"></script>
		<script src="js/formatPrefix.js"></script>
		<script src="js/maxComm.js"></script>

</head>
<body>

	  <div>
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
	</div>
	<div class="sidebar">
		@yield('content')
	</div>
	<div class="centered" id="centered">
		@yield('stuff')
	</div>

<div id="slidez">
		@yield('morestuff')
  </div>

</body>
</html>
