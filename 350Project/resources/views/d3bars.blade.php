<!DOCTYPE html>
<meta charset="utf-8">

<head>
	<style>

  .bar{
    fill: steelblue;
  }

  .bar:hover{
    fill: brown;
  }

	.axis {
	  font: 10px sans-serif;
	}

	.axis path,
	.axis line {
	  fill: none;
	  stroke: #000;
	  shape-rendering: crispEdges;
	}

	</style>
</head>

<body>

<script src="http://d3js.org/d3.v3.min.js"></script>

<script>
var arr = new Array();
var dataset = [

	{"Reporter":"Canada","Partner":"USA","Year":"2015","Export":313591646888,"Commodity":"All Commodities","Import":223198723384},
	{"Reporter":"Canada","Partner":"China","Year":"2015","Export":15824358949,"Commodity":"All Commodities","Import":51377078664},
	{"Reporter":"Canada","Partner":"UK","Year":"2015","Export":12482992375,"Commodity":"All Commodities","Import":7196172635},
	{"Reporter":"Canada","Partner":"Japan","Year":"2015","Export":7641596196,"Commodity":"All Commodities","Import":11564100933},
	{"Reporter":"Canada","Partner":"Mexico","Year":"2015","Export":5160095761,"Commodity":"All Commodities","Import":24415765939},
	{"Reporter":"Canada","Partner":"India","Year":"2015","Export":3381672928,"Commodity":"All Commodities","Import":3079915506},
	{"Reporter":"Canada","Partner":"Rep. of Korea","Year":"2015","Export":3151626441,"Commodity":"All Commodities","Import":6164497135},
	{"Reporter":"Canada","Partner":"China, Hong Kong SAR","Year":"2015","Export":3059210947,"Commodity":"All Commodities","Import":252919474},
	{"Reporter":"Canada","Partner":"Netherlands","Year":"2015","Export":2781571272,"Commodity":"All Commodities","Import":2687173095},
	{"Reporter":"Canada","Partner":"Germany","Year":"2015","Export":2705294302,"Commodity":"All Commodities","Import":13571670164}];

	for (var i = 0; i < dataset.length; i++) {
		arr.push(dataset[i].Export);
	}
// set the dimensions of the canvas
var margin = {top: 20, right: 20, bottom: 70, left: 100},
    width = 600 - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom;


// set the ranges
var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

var y = d3.scale.linear().range([height, 0]);


// define the axis
var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom")


var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .ticks(10);


// add the SVG element
var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  	 .append("g")
    .attr("transform",
          "translate(" + margin.left + "," + margin.top + ")")



// load the data


  // scale the range of the data
  x.domain(dataset.map(function(d) { return d.Partner; }));
  y.domain([0, d3.max(dataset, function(d) { return d.Export; })]);

  // add axis
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
    .selectAll("text")
      .style("text-anchor", "end")
		
      .attr("dx", "-.8em")
      .attr("dy", "-.55em")
      .attr("transform", "rotate(-90)" );

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 5)
      .attr("dy", ".71em")
      .style("text-anchor", "end")



  // Add bar chart
  svg.selectAll("bar")
  		.data(dataset)
    	.enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.Partner); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.Export); })
      .attr("height", function(d) { return height - y(d.Export); })
		.append("title")
		.text(function(d) {
			return d.Partner + ": " + d.Export;
	});




</script>

</body>
