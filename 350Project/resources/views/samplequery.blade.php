<!DOCTYPE html>
<head>
	<script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>
	<div id="chart"></div>
	<div>
		<script>
		var w = 400;
var h = 400;
var r = h/2;
var color = d3.scale.category20c();
var data = <?php echo json_encode($data)?>;
var dataz = [{"label":"Category A", "value":20},
		      {"label":"Category B", "value":50},
		      {"label":"Category C", "value":30}];


var vis = d3.select('#chart').append("svg:svg").data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
var pie = d3.layout.pie().value(function(d){return d.Export;});

// declare an arc generator function
var arc = d3.svg.arc().outerRadius(r);

// select paths, use arc generator to draw
var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice");
arcs.append("svg:path")
    .attr("fill", function(d, i){
        return color(i);
    })
    .attr("d", function (d) {
        // log the result of the arc generator to show how cool it is :)
        console.log(arc(d));
        return arc(d);
    })
	 .attr("data-legend",function(d) { return d.Commodity });

// add the text
/**arcs.append("svg:text").attr("transform", function(d){
			d.innerRadius = 0;
			d.outerRadius = r;
    return "translate(" + arc.centroid(d) + ")";}).attr("dy", "0.35em").text( function(d, i) {
    return data[i].Commodity;}
 );**/

		</script>
	</div>
	<div>
		@foreach($data as $dt)
			<p>{{$dt}}</p>
		@endforeach
	</div>
</body>
