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
					var max = get_max(data);
			      // Scale the range of the data
			      x.domain(d3.extent(data, function(d) { return d.Year; }));
			  	 if (max == "Export") {
			  		  y.domain([0, d3.max(data, function(d) { return d.Export; })]);
			  	 } else {
			  		  y.domain([0, d3.max(data, function(d) { return d.Import; })]);
			  	 }

		     	// Scale the range of the data again
		     	//x.domain(d3.extent(data, function(d) { return d.Year; }));
		 	   //y.domain([0, d3.max(data, function(d) { return d.Export; })]);
		     // Select the section we want to apply our changes to

		     //Transition Section
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
	<h4 class="w3-bar-item">Line Graph</h4>
	<form method="GET" id="frm">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
		<div class="form-group">
	 	<label class="col-md-4 control-label">Exporter</label>
	 		<select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop">
				<option value="Algeria">Algeria</option>
	 			<option value="Argentina">Argentina</option>
	 			<option value="Australia">Australia</option>
	 			<option value="Brazil">Brazil</option>
				<option selected>Canada</option>
				<option value="China">China</option>
				<option value="Colombia">Colombia</option>
				<option value="Egypt">Egypt</option>
				<option value="France">France</option>
				<option value="Germany">Germany</option>
				<option value="Greece">Greece</option>
				<option value="India">India</option>
				<option value="Indonesia">Indonesia</option>
				<option value="Iran">Iran</option>
				<option value="Israel">Israel</option>
				<option value="Italy">Italy</option>
				<option value="Japan">Japan</option>
				<option value="Mexico">Mexico</option>
				<option value="New Zealand">New Zealand</option>
				<option value="Nigeria">Nigeria</option>
				<option value="Russian Federation">Russia</option>
				<option value="Saudi Arabia">Saudi Arabia</option>
				<option value="South Africa">South Africa</option>
				<option value="Rep. of Korea ">S. Korea</option>
				<option value="Spain">Spain</option>
				<option value="Turkey">Turkey</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="USA">USA</option>
				<option value="Venezuela">Venezuela</option>
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
				<option value="Algeria">Algeria</option>
	 			<option value="Argentina">Argentina</option>
	 			<option value="Australia">Australia</option>
	 			<option value="Brazil">Brazil</option>
				<option value="Canada">Canada</option>
				<option value="China">China</option>
				<option value="Colombia">Colombia</option>
				<option value="Egypt">Egypt</option>
				<option value="France">France</option>
				<option value="Germany">Germany</option>
				<option value="Greece">Greece</option>
				<option selected>India</option>
				<option value="Indonesia">Indonesia</option>
				<option value="Iran">Iran</option>
				<option value="Israel">Israel</option>
				<option value="Italy">Italy</option>
				<option value="Japan">Japan</option>
				<option value="Mexico">Mexico</option>
				<option value="New Zealand">New Zealand</option>
				<option value="Nigeria">Nigeria</option>
				<option value="Russian Federation">Russia</option>
				<option value="Saudi Arabia">Saudi Arabia</option>
				<option value="South Africa">South Africa</option>
				<option value="Rep. of Korea ">S. Korea</option>
				<option value="Spain">Spain</option>
				<option value="Turkey">Turkey</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="USA">USA</option>
				<option value="Venezuela">Venezuela</option>
		 	</select>
	 	</div>
	</form>
</div>
@stop
@section('stuff')
<script>
var data = <?php echo json_encode($data)?>;
console.log(data);

var margin = {top: 30, right: 500, bottom: 75, left: 75},
    width = 1200 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

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
var mouseG = svg.append("g")
	.attr("class", "mouse-over-effects");

mouseG.append("path")//black vertical line for the mouse to follow
	.attr("class", "mouse-line")
    .style("stroke", "black")
    .style("stroke-width", "1px")
    .style("opacity", "0");

var color = d3.scale.category10();


var lines2 = document.getElementsByClassName('linepath');

//var lines = [].concat([lines3.item(0), lines2.item(0)]);
//lines = lines.concat(document.getElementsByClassName('line2'));

//g for the circles and text
var mousePerLine = mouseG.selectAll('.mouse-per-line')
	.data(data)//d3.range(lines/length))
	.enter()
	.append("g")
	.attr("class", "mouse-per-line");

mousePerLine.append("circle")
      .attr("r", 7)
      .style("stroke", function(d) {
        return 'red';//color(d.name);
      })
      .style("fill", "none")
      .style("stroke-width", "1px")
      .style("opacity", "0");

mousePerLine.append("text")
      .attr("transform", "translate(10,3)");

mouseG.append('svg:rect')//append the rect to catch the movement
	.attr('width', width)
	.attr('height', height)
    .attr('fill', 'none')
    .attr('pointer-events', 'all')
    .on('mouseout', function() { // on mouse out hide line, circles and text
        d3.select(".mouse-line")
          .style("opacity", "0");
        d3.selectAll(".mouse-per-line circle")
          .style("opacity", "0");
        d3.selectAll(".mouse-per-line text")
          .style("opacity", "0");
    })
    .on('mouseover', function() { // on mouse in show line, circles and text
        d3.select(".mouse-line")
          .style("opacity", "1");
        d3.selectAll(".mouse-per-line circle")
          .style("opacity", "1");
        d3.selectAll(".mouse-per-line text")
          .style("opacity", "1");
    })
    .on('mousemove', function() { // mouse moving over canvas
        var mouse = d3.mouse(this);
        d3.select(".mouse-line")
          .attr("d", function() {
            var d = "M" + mouse[0] + "," + height;
            d += " " + mouse[0] + "," + 0;
            return d;
     	});
          d3.selectAll(".mouse-per-line")
          .attr("transform", function(d, i) {
            console.log(width/mouse[0])
            var xDate = x.invert(mouse[0]),
                bisect = d3.bisector(function(d) { return d.date; }).right;
                idx = bisect(data, xDate);

            var beginning = 0,
                end = lines2[i].getTotalLength(),
                target = null;

            while (true){
              target = Math.floor((beginning + end) / 2);
              pos = lines2[i].getPointAtLength(target);
              if ((target === end || target === beginning) && pos.x !== mouse[0]) {
                  break;
              }
              if (pos.x > mouse[0])      end = target;
              else if (pos.x < mouse[0]) beginning = target;
              else break; //position found
            }

            d3.select(this).select("text")
              .text(y.invert(pos.y).toFixed(2));

            return "translate(" + mouse[0] + "," + pos.y +")";
          });

      });



// Get the data
	console.log(data[0].Year);
	for (var i = 0; i < data.length; i++) {
		data[i].Year = parseDate(data[i].Year);
	}
	console.log(data[0].Year);
	 var max = get_max(data);
    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.Year; }));
	 if (max == "Export") {
		  y.domain([0, d3.max(data, function(d) { return d.Export; })]);
	 } else {
		  y.domain([0, d3.max(data, function(d) { return d.Import; })]);
	 }
    //y.domain([0, d3.max(data, function(d) { return d.Export; }, function(d){return d.Import})]);
    // Add the valueline path.
    svg.append("path")
    	.attr("id", "linepath")
        .attr("class", "line linepath")
        .style("stroke", "#0E40E3")
        .attr("d", valueline(data));

    svg.append("path")
    	.attr("class", "line2 linepath")
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

    // make the graph title
    svg.append("text")
		    .attr("x", (width / 2))
		    .attr("y", 0 - (margin.top / 2.5))
		    .attr("text-anchor", "middle")
		    .style("font-size", "16px")
		    .style("text-decoration", "underline")
		    .text("Imports/Exports of Commodity between Countries");

	 svg.append("text")
			  .attr("transform", "rotate(-90)")
			  .attr("y", -60)
			  .attr("x", margin.top - (height / 3))
			  .attr("dy", ".71em")
			  .text("USD ($)");

	 svg.append("text")             // text label for the x axis
		     .attr("x", 265 )
		     .attr("y",  440 )
		     .style("text-anchor", "middle")
		     .text("Year");
// legend bit
		    var colorScale = d3.scale.ordinal()
	        .domain([ "Exporter to Importer", "Importer to Exporter" ])
	        .range(["#0E40E3","#B90EE3"]);

	      var colorLegend = d3.legend.color()
	        .labelFormat(d3.format(".0f"))

	        .scale(colorScale)
	        .shapePadding(5)
	        .shapeWidth(25)
	        .shapeHeight(20)
	        .labelOffset(12);

	      svg.append("g")
	        .attr("transform", "translate(640, 60)")
	        .call(colorLegend);

</script>
@stop
