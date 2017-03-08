@extends('layout')

@section('content')
<h1>Graph Proj</h1>
<meta charset="utf-8">
<style>

.chart rect {
  fill: steelblue;
}

.chart text {
  fill: white;
	 font: 10px sans-serif;
	 text-anchor: end;
}

</style>
<svg class="chart"></svg>
<script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script>
	var data = new Array();
	@foreach ($coords as $coord)
   var test = <?php echo json_encode($coord)?>;
   document.write(test.x);
	if (test.y != 0) {
		data.push(test.y);
	}
	@endforeach
	data.push(36);
	document.write(data);
	var width = 420,
	    barHeight = 20;

	var x = d3.scale.linear()
	    .domain([0, d3.max(data)])
	    .range([0, width]);

	var chart = d3.select(".chart")
	    .attr("width", width)
	    .attr("height", barHeight * data.length);

	var bar = chart.selectAll("g")
	    .data(data)
	  .enter().append("g")
	    .attr("transform", function(d, i) { return "translate(0," + i * barHeight + ")"; });

	bar.append("rect")
	    .attr("width", x)
	    .attr("height", barHeight - 1);

	bar.append("text")
	    .attr("x", function(d) { return x(d) - 3; })
	    .attr("y", barHeight / 2)
	    .attr("dy", ".35em")
	    .text(function(d) { return d; });

</script>
@foreach ($coords as $coord)
	<div>

		{{ $coord->x }} {{ $coord->y }}

	</div>
@endforeach
@stop
