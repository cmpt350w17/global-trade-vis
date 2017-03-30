@extends('layouts.master3')

@section('content')
<link rel="stylesheet" href="css/centeredLines.css">
<script>

//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
	var Exporter = 'Canada';
	var Commodity = 'All Commodities';
	var Importer = 'India';

	//console.log(jdata);
	$(".custom-select").click(function() {
		Exporter = $("#drop").val();
		Commodity = $("#drop2").val();
		Importer = $("#drop3").val();
		if (Exporter != Importer) {
			$.ajax({
				 type: 'GET',
				 url: '{!!URL::to('lineinfo')!!}',
				 data: { 'Exporter': Exporter, 'Commodity': Commodity, 'Importer': Importer},
				 success: function(data) {
					 console.log('success');
					 console.log(data);
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
		         svg.select(".line2")
		         	 .duration(750)
		         	 .attr("d", importline(data));
		         svg.select(".x.axis") // change the x axis
		             .duration(750)
		             .call(xAxis);
		         svg.select(".y.axis") // change the y axis
		             .duration(750)
		             .call(yAxis);




				}});
		  }
		});
	});

</script>
<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" id="sidebar">
	<h4 class="w3-bar-item">Global Trade Vis</h4>
	<form method="GET" id="frm">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
		<div class="form-group">
	 	<label class="col-md-4 control-label">Exporter</label>
	 		<select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop">
				<option selected>Canada</option>
				<option value="USA">USA</option>
				<option value="Japan">Japan</option>
				<option value="China">China</option>
				<option value="India">India</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="France">France</option>
				<option value="Brazil">Brazil</option>
				<option value="Italy">Italy</option>
				<option value="Germany">Germany</option>
				<option value="Mexico">Mexico</option>
				<option value="Turkey">Turkey</option>
	 		</select>
  		</div>
		<div class="form-group">
		<label class="col-md-4 control-label">Commodity</label>
			<select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop2">
		  		<option selected>All Commodities</option>
		  		<option value="Pearls, precious stones, metals, coins, etc">Pearls, precious stones, metals, coins, etc</option>
		  		<option value="Iron and steel">Iron and steel</option>
		  		<option value="Electrical, electronic equipment">Electrical, electronic equipment</option>
		  		<option value="Meat and edible meat offal">Meat and edible meat offal</option>
		  		<option value="Edible vegetables and certain roots and tubers">Edible vegetables and certain roots and tubers</option>
		  		<option value="Coffee, tea, mate and spices">Coffee, tea, mate and spices</option>
		  		<option value="Cereal, flour, starch, milk preparations and products">Cereal, flour, starch, milk preparations and products</option>
		  		<option value="Vegetable, fruit, nut, etc food preparations">Vegetable, fruit, nut, etc food preparations</option>
		  		<option value="Ores, slag and ash">Ores, slag and ash</option>
		  		<option value="Petroleum oils and oils obtained from bituminous minerals, crude.">Petroleum oils and oils obtained from bituminous minerals, crude.</option>
		  		<option value="Inorganic chemicals, precious metal compound, isotope">Inorganic chemicals, precious metal compound, isotope</option>
		  		<option value="Radioactive chemical elements and radioactive isotopes">Radioactive chemical elements and radioactive isotopes</option>
		  		<option value="Pharmaceutical products">Pharmaceutical products</option>
		  		<option value="Wood and articles of wood, wood charcoal">Wood and articles of wood, wood charcoal</option>
		  		<option value="Textile articles, sets, worn clothing etc">Textile articles, sets, worn clothing etc</option>
		  		<option value="Vehicles other than railway, tramway">Vehicles other than railway, tramway</option>
		  		<option value="Arms and ammunition, parts and accessories thereof">Arms and ammunition, parts and accessories thereof</option>
			</select>
		</div>

	  	<div class="form-group">
		  	<label class="col-md-4 control-label">Importer</label>
		  	<select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop3">
				<option selected>India</option>
				<option value="USA">USA</option>
				<option value="Japan">Japan</option>
				<option value="China">China</option>
				<option value="Canada">Canada</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="France">France</option>
				<option value="Brazil">Brazil</option>
				<option value="Italy">Italy</option>
				<option value="Germany">Germany</option>
				<option value="Mexico">Mexico</option>
				<option value="Turkey">Turkey</option>
		 	</select>
	 	</div>
	</form>
</div>
@stop
@section('stuff')
<script>
var data = <?php echo json_encode($data)?>;
console.log(data);

var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 1000 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%Y").parse;
// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);
// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(10);



var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(5)
	 .tickFormat(d3.format("2s"));
// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.Year); })
    .y(function(d) { return y(d.Export); });

var importline = d3.svg.line()
	.x(function(d) {return x(d.Year);})
	.y(function(d) {return y(d.Import);})  

// Adds the svg canvas
var svg = d3.select(".centered")
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
        .style("stroke", "#0E40E3")
        .attr("d", valueline(data));

    svg.append("path")
    	.attr("class", "line2")
    	.style("stroke", "#B90EE3" )
    	.attr("d", importline(data));
    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);
    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

</script>
@stop
