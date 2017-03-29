<!DOCTYPE html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crossfilter/1.3.12/crossfilter.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dc/2.0.0-beta.29/dc.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dc/2.0.0-beta.29/dc.css" media="screen"/>
	<script src="js/formatPrefix.js"></script>
</head>
<body>
	<div class="container" style="font: 12px sans-serif;">
		<div class='row'>
	    <div class='span6' id='b-chart'>
	      <h4>Exports</h4>
	    </div>
	 </div>
	<div>
		<script>
		function print_filter(filter) {
			var f=eval(filter);
			if (typeof(f.length) != "undefined") {}else{}
			if (typeof(f.top) != "undefined") {f=f.top(Infinity);}else{}
			if (typeof(f.dimension) != "undefined") {f=f.dimension(function(d) { return "";}).top(Infinity);}else{}
			console.log(filter+"("+f.length+") = "+JSON.stringify(f).replace("[","[\n\t").replace(/}\,/g,"},\n\t").replace("]","\n]"));
		}
			var data = <?php echo json_encode($data)?>;
			//data.shift();
			//console.log(data);
			var ndx = crossfilter(data);
			var PartDim = ndx.dimension(function(d) { return d.Partner });
			var contDim = ndx.dimension(function(d) { return d.Continent });
			contDim.filter("North America");
			print_filter(ndx);








		</script>
	</div>

</body>
