@extends('layouts.master3')

@section('content')
<script>


//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
	var country = 'Canada';
	var commodity = 'All Commodities';
	var year = '2015';

	//console.log(jdata);
	$(".custom-select").click(function() {
		country = $("#drop").val();
		commodity = $("#drop2").val();
		year = $("#drop3").val();
		$.ajax({
				 type: 'GET',
				 url: '{!!URL::to('ajaxget')!!}',
				 data: { 'country': country, 'commodity': commodity, 'year': year},
				 success: function(data) {
					 console.log('success');
					 //console.log(data);
					 data.shift();
					 var max = get_max(data);
					 console.log(max);
					 x.domain(data.map(function(d) { return d.Partner; }));
					 if (max == "Export") {
						  y.domain([0, d3.max(data, function(d) { return d.Export; })]);
					 } else {
						  y.domain([0, d3.max(data, function(d) { return d.Import; })]);
					 }

			  	  //var svg = d3.select("body");




			  	  svg.select(".x.axis") // change the x axis
			  	  		.transition()
			  			.duration(500)
			  			.call(xAxis)
			  			.selectAll("text")

			  			.style("text-anchor", "end")
			  	      .attr("dx", "-.8em")
			  	      .attr("dy", "-.55em")
			  	      .attr("transform", "rotate(-90)" );

			  	  svg.select(".y.axis") // change the y axis
			  	  		.transition()
			  			.duration(500)
			  			.call(yAxis);



					 var rect = svg.selectAll(".bar1").data(data);

	  				 rect.transition().duration(750)
	  				 .attr("y", function(d) { return y(d.Export); })
	  				 .attr("height", function(d) { return height - y(d.Export); });

	  				 rect = svg.selectAll(".bar2").data(data);
	  				 rect.transition().duration(750)
	  				 //.attr("x", function(d) { return x(d.Partner) + 22; })
	  				 .attr("y", function(d) { return y(d.Import); })
	  				 .attr("height", function(d) { return height - y(d.Import); });


				}});

		});
	});

</script>
<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" id="sidebar">
	<h4 class="w3-bar-item">Global Trade Vis</h4>
	<form method="GET" id="frm">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
		<div class="form-group">
	 	<label class="col-md-4 control-label">Country</label>
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
		  	<label class="col-md-4 control-label">Year</label>
		  	<select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop3">
			 	<option selected>2015</option>
				<option value="1997">1997</option>
			 	<option value="2000">2000</option>
			 	<option value="2003">2003</option>
			 	<option value="2006">2006</option>
			 	<option value="2009">2009</option>
			 	<option value="2011">2011</option>
			 	<option value="2012">2012</option>
			 	<option value="2013">2013</option>
			 	<option value="2014">2014</option>
		 	</select>
	 	</div>
	</form>
</div>
@stop
@section('stuff')

	<script>
	var data = <?php echo json_encode($data)?>;
	data.shift();
	var max = get_max(data);
	//console.log(max);
	var margin = {top: 20, right: 100, bottom: 200, left: 100},
	    width = 700 - margin.left - margin.right,
	    height = 480 - margin.top - margin.bottom;

	// Parse the date / time
	//var	parseDate = d3.time.format("%Y").parse;

	var x = d3.scale.ordinal().rangeRoundBands([0, width], .1);

	var y = d3.scale.linear().range([height, 0]);

	var xAxis = d3.svg.axis()
	    .scale(x)
	    .orient("bottom")
	    .ticks(10);

	var yAxis = d3.svg.axis()
	    .scale(y)
	    .orient("left")
	    .ticks(5)
		 .tickFormat(d3.format("2s"));

	var svg = d3.select(".centered").append("svg")
	    .attr("width", width + margin.left + margin.right)
	    .attr("height", height + margin.top + margin.bottom)
	    .append("g")
	    .attr("transform",
	          "translate(" + margin.left + "," + margin.top + ")");




	  x.domain(data.map(function(d) { return d.Partner; }));
	  if (max == "Export") {
	  	  y.domain([0, d3.max(data, function(d) { return d.Export; })]);
	  } else {
		  y.domain([0, d3.max(data, function(d) { return d.Import; })]);
	  }

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
	      .attr("y", 6)
	      .attr("dy", ".71em")
	      .style("text-anchor", "end")

			// Color legend.
	      var colorScale = d3.scale.ordinal()
	        .domain([ "Exports", "Imports" ])
	        .range(["#0E40E3","#B90EE3"]);

	      var colorLegend = d3.legend.color()
	        .labelFormat(d3.format(".0f"))
	        .scale(colorScale)
	        .shapePadding(5)
	        .shapeWidth(25)
	        .shapeHeight(20)
	        .labelOffset(12);

	      svg.append("g")
	        .attr("transform", "translate(520, 60)")
	        .call(colorLegend);

	 svg.append("text")
	       .attr("transform", "rotate(-90)")
	       .attr("y", -70)
	       .attr("x", margin.top - (height / 3))
	       .attr("dy", ".71em")
			 .text("USD ($)");

	 svg.append("text")
		    .attr("x", (width / 2))
		    .attr("y", 0 - (margin.top / 2.5))
		    .attr("text-anchor", "middle")
		    .style("font-size", "16px")
		    .style("text-decoration", "underline")
		    .text("Top 10 Trading Partners");

	  var bars = svg.selectAll("bars").data(data).enter();

	  bars.append("rect")
	 			.attr("class","bar1")
	 			.style("fill", "#0E40E3")
	 	      .attr("x", function(d) { return x(d.Partner); })
	 	      .attr("width", x.rangeBand()/2)
	 	      .attr("y", function(d) { return y(d.Export); })
	 	      .attr("height", function(d) { return height - y(d.Export); });
	  bars.append("rect")
	 			.attr("class","bar2")
	 			.style("fill", "#B90EE3")
	 	      .attr("x", function(d) { return x(d.Partner) + 22.2; })
	 	      .attr("width", x.rangeBand()/2)
	 			.attr("y", function(d) { return y(d.Import); })
	 	      .attr("height", function(d) { return height - y(d.Import); });



	</script>

@stop
