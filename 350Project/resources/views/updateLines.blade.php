<!DOCTYPE html>
<meta charset="utf-8">
<style> /* set the CSS */
body { font: 12px Arial;}
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
</style>
<body>

<div id="option">
    <input name="updateButton"
           type="button"
           value="Update"
           onclick="updateData()" />
</div>

<!-- load the d3.js library -->
<script src="http://d3js.org/d3.v3.min.js"></script>

<script>
var data = [{"Reporter":"France","Partner":"Germany","Year":"1997","Export":12359446,"Commodity":"Ores, slag and ash","Import":23872456},
{"Reporter":"France","Partner":"Germany","Year":"2000","Export":21576693,"Commodity":"Ores, slag and ash","Import":16625148},
{"Reporter":"France","Partner":"Germany","Year":"2003","Export":10062255,"Commodity":"Ores, slag and ash","Import":14799891},
{"Reporter":"France","Partner":"Germany","Year":"2006","Export":18738468,"Commodity":"Ores, slag and ash","Import":19864021},
{"Reporter":"France","Partner":"Germany","Year":"2009","Export":34655324,"Commodity":"Ores, slag and ash","Import":22573729},
{"Reporter":"France","Partner":"Germany","Year":"2011","Export":65113132,"Commodity":"Ores, slag and ash","Import":34591355},
{"Reporter":"France","Partner":"Germany","Year":"2012","Export":137434820,"Commodity":"Ores, slag and ash","Import":42690948},
{"Reporter":"France","Partner":"Germany","Year":"2013","Export":125958141,"Commodity":"Ores, slag and ash","Import":66379740},
{"Reporter":"France","Partner":"Germany","Year":"2014","Export":73095194,"Commodity":"Ores, slag and ash","Import":73705420},
{"Reporter":"France","Partner":"Germany","Year":"2015","Export":48183655,"Commodity":"Ores, slag and ash","Import":59154457}];

var testd2 = [{"Reporter":"Turkey","Partner":"China","Year":"1997","Export":18433048,"Commodity":"Ores, slag and ash","Import":3318669},
{"Reporter":"Turkey","Partner":"China","Year":"2000","Export":5890205,"Commodity":"Ores, slag and ash","Import":3372948},
{"Reporter":"Turkey","Partner":"China","Year":"2003","Export":9746326,"Commodity":"Ores, slag and ash","Import":5230857},
{"Reporter":"Turkey","Partner":"China","Year":"2006","Export":117028817,"Commodity":"Ores, slag and ash","Import":7947401},
{"Reporter":"Turkey","Partner":"China","Year":"2009","Export":531775024,"Commodity":"Ores, slag and ash","Import":7022633},
{"Reporter":"Turkey","Partner":"China","Year":"2011","Export":748946116,"Commodity":"Ores, slag and ash","Import":12518700},
{"Reporter":"Turkey","Partner":"China","Year":"2012","Export":932627514,"Commodity":"Ores, slag and ash","Import":10277452},
{"Reporter":"Turkey","Partner":"China","Year":"2013","Export":1362720615,"Commodity":"Ores, slag and ash","Import":12226095},
{"Reporter":"Turkey","Partner":"China","Year":"2014","Export":841871019,"Commodity":"Ores, slag and ash","Import":11105607},
{"Reporter":"Turkey","Partner":"China","Year":"2015","Export":549868394,"Commodity":"Ores, slag and ash","Import":9536609}];
// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 600 - margin.left - margin.right,
    height = 270 - margin.top - margin.bottom;
// Parse the date / time
var parseDate = d3.time.format("%Y").parse;
// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);
// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(10);



var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(5);
// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.Year); })
    .y(function(d) { return y(d.Export); });

// Adds the svg canvas
var svg = d3.select("body")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    	  .append("g")
        .attr("transform",
              "translate(" + margin.left + "," + margin.top + ")");
// Get the data
	console.log(data[0].Year);
	for (var i = 0; i < data.length; i++) {
		data[i].Year = parseDate(data[i].Year);
	}
	console.log(data[0].Year);

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.Year; }));
    y.domain([0, d3.max(data, function(d) { return d.Export; })]);
    // Add the valueline path.
    svg.append("path")
        .attr("class", "line")
        .attr("d", valueline(data));
    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);
    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

// ** Update data section (Called from the onclick)
function updateData() {
    // Get the data again

       	data = testd2;
			for (var i = 0; i < data.length; i++) {
				data[i].Year = parseDate(data[i].Year);
			}

    	// Scale the range of the data again
    	x.domain(d3.extent(data, function(d) { return d.Year; }));
	   y.domain([0, d3.max(data, function(d) { return d.Export; })]);
    // Select the section we want to apply our changes to
    var svg = d3.select("body").transition();
    // Make the changes
        svg.select(".line")   // change the line
            .duration(750)
            .attr("d", valueline(data));
        svg.select(".x.axis") // change the x axis
            .duration(750)
            .call(xAxis);
        svg.select(".y.axis") // change the y axis
            .duration(750)
            .call(yAxis);

}
</script>
</body>
