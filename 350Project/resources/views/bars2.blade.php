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
					 console.log(data);
					 data.shift();
					 x.domain(data.map(function(d) { return d.Partner; }));
			       y.domain([0, d3.max(data, function(d) { return d.Export; })]);

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



			  	 svg.selectAll("rect")

			  	 .data(data)
			  	 .transition().duration(750)
			  	 .attr("y", function(d) { return y(d.Export); })
			  	 .attr("height", function(d) { return height - y(d.Export); })


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
	var margin = {top: 20, right: 20, bottom: 70, left: 40},
	    width = 500 - margin.left - margin.right,
	    height = 350 - margin.top - margin.bottom;

	// Parse the date / time
	//var	parseDate = d3.time.format("%Y").parse;

	var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

	var y = d3.scale.linear().range([height, 0]);

	var xAxis = d3.svg.axis()
	    .scale(x)
	    .orient("bottom")
	    .ticks(10);

	var yAxis = d3.svg.axis()
	    .scale(y)
	    .orient("left")
	    .ticks(5);

	var svg = d3.select(".centered").append("svg")
	    .attr("width", width + margin.left + margin.right)
	    .attr("height", height + margin.top + margin.bottom)
	    .append("g")
	    .attr("transform",
	          "translate(" + margin.left + "," + margin.top + ")");




	  x.domain(data.map(function(d) { return d.Partner; }));
	  y.domain([0, d3.max(data, function(d) { return d.Export; })]);

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


	  svg.selectAll("bars")
	      .data(data)
	      .enter().append("rect")

	      .style("fill", "steelblue")
	      .attr("x", function(d) { return x(d.Partner); })
	      .attr("width", x.rangeBand())
	      .attr("y", function(d) { return y(d.Export); })
	      .attr("height", function(d) { return height - y(d.Export); });

	</script>

@stop
