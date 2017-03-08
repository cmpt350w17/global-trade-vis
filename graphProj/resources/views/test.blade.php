@extends('layout')


@section('content')
<LINK REL=StyleSheet HREF="css/bars.css">
<script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script>
	var dataset = new Array();
	@foreach ($coords as $coord)
		var test = <?php echo json_encode($coord, JSON_PRETTY_PRINT)?>;
		if (test.y != 0) {
			dataset.push(test.y);
		}
	@endforeach
	dataset.push(36);
	document.write(dataset);
	d3.select("body").selectAll("div")
		.data(dataset)
		.enter()
		.append("div")
		.attr("class","bar")
		.style("height",function(d) {
			var barHeight = d * 5;
			return barHeight + "px";
		});
</script>
@stop

@section('morecontent')
<script>
	var nums = [ 5, 10, 15, 20, 25 ];
	var svg = d3.select("body").append("svg")
										.attr("width", 500)
										.attr("height",100);
	svg.selectAll("circle")
		.data(nums)
		.enter().append("circle")
		.attr("cx",function(d, i) {
			return (i * 60) + 25;
		})
		.attr("cy", 50)
		.attr("r",function(d) { return d; })
		.attr("fill","yellow")
		.attr("stroke", "orange")
		.attr("stroke-width",function(d) {
			return d/3;
		});

</script>
@stop

@section('scatter')
<style>
	.axis path,
	.axis line {
 		fill: none;
 		stroke: black;
 		shape-rendering: crispEdges;
	}

	.axis text {
 		font-family: sans-serif;
 		font-size: 11px;
	}
</style>
<script>
var dataset = [
                [5, 20], [480, 90], [250, 50], [100, 33], [330, 95],
                [410, 12], [475, 44], [25, 67], [85, 21], [220, 88]
              ];
var svg = d3.select("body").append("svg")
				.attr("width", 500)
				.attr("height",200);
var padding = 20;

var xScale = d3.scale.linear()
				   .domain([0, d3.max(dataset, function(d) { return d[0]; })])
				   .range([padding, 500 - padding]);

var yScale = d3.scale.linear()
					.domain([0, d3.max(dataset, function(d) { return d[1]; })])
					.range([200 - padding, padding]);

var xAxis = d3.svg.axis()
				  .scale(xScale)
				  .orient("bottom")
				  .ticks(6);

var yAxis = d3.svg.axis()
				  .scale(yScale)
				  .orient("left")
				  .ticks(5);

svg.selectAll("circle")
	.data(dataset)
	.enter()
	.append("circle")
	.attr("cx",function(d) { return xScale(d[0]); })
	.attr("cy",function(d) { return yScale(d[1]); })
	.attr("r", 5);

svg.append("g")
	.attr("class","axis")
	.attr("transform","translate(0," + (200 - padding) + ")")
	.call(xAxis)

svg.append("g")
	.attr("class", "axis")
	.attr("transform", "translate(" + padding + ",0)")
	.call(yAxis);




</script>
@stop
