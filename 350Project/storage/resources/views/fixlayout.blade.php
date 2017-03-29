<!DOCTYPE html>
<html>
<style>
#hello {
	width: 250px;

	margin: -5px;
	margin-top: -5px;
}
.custom-select {
   width: 175px;
	margin: 5px;
}
#slider {
   margin-top: 20px;
	width: 175px;
}
#sidebar {
	margin-top: -19px;
	width:15%;
}

</style>

<head>
	<title>Global Trade Vis</title>
   	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   	<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
		<script src="http://d3js.org/d3.v3.min.js"></script>
</head>
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
		 if (country != "Choose...") {
			 //console.log(country);
			 $.ajax({
				 type: 'GET',
				 url: '{!!URL::to('ajaxget')!!}',
				 data: { 'country': country, 'commodity': commodity, 'year': year},
				 success: function(data) {
					 console.log('success');
					 console.log(data);

				}});
		 	}
		});
	});

</script>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header"></div>
		<ul class="nav navbar-nav">
			<li> <a href="/">Map View</a></li>
         <li><a href="bars">Bar view</a></li>
			<li><a href="lines">Line view</a></li>
         <li><a href="disc">Disc view</a></li>
			<li><label class="col-md-4 control-label">Country</label>
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
			</li>
			<li>
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
			</li>
			<li>
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
		</li>
		</ul>
	</div>
</nav>
<body>
</body>
</html>
