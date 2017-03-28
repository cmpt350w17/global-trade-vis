@extends('layouts.master3')

@section('content')
<script>

//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
	function resetData(ndx, dimensions) {
    var bChartFilters = bChart.filters();
    bChart.filter(null);
    ndx.remove();
    bChart.filter([bChartFilters]);
    console.log(bChart.filters());
}
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
					 var ndx = crossfilter(data);
 					//print_filter(data);
 					//var Exports = ndx.dimension(function(d) { return d.Export; });
 					var Countries = ndx.dimension(function(d) { return d.Partner });
 					var test = Countries.group().reduceSum(function(d) { return d.Export });
					bChart
					.dimension(Countries)
					.group(test);
					dc.redrawAll();


				}});

	});
});
</script>
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
	function print_filter(filter) {
		var f=eval(filter);
		if (typeof(f.length) != "undefined") {}else{}
		if (typeof(f.top) != "undefined") {f=f.top(Infinity);}else{}
		if (typeof(f.dimension) != "undefined") {f=f.dimension(function(d) { return "";}).top(Infinity);}else{}
		console.log(filter+"("+f.length+") = "+JSON.stringify(f).replace("[","[\n\t").replace(/}\,/g,"},\n\t").replace("]","\n]"));
	}
	var data = <?php echo json_encode($data)?>;
	//console.log(data);
	data.shift();
	var ndx = crossfilter(data);
	//print_filter(data);
	//var Exports = ndx.dimension(function(d) { return d.Export; });
	var Countries = ndx.dimension(function(d) { return d.Partner });
	var test = Countries.group().reduceSum(function(d) { return d.Export });
	//var minExport = Exports.bottom(1)[0].Year;
	//var maxExport = Exports.top(1)[0].Year;
	var bChart  = dc.barChart("#centered");
	bChart
		.width(500).height(350)
		.margins({top: 10, right: 10, bottom: 150, left: 50})
		.dimension(Countries)
		.group(test)
		.x(d3.scale.ordinal())
		.xUnits(dc.units.ordinal)
		.on('renderlet', function(chart) {
			chart.selectAll("g.x text")
			.transition(500)
			.attr('transform', "rotate(-90)")
			.style("text-anchor", "end")
			.attr("dx", "-.8em")
			.attr("dy", "-.55em");

		});
	bChart.xAxis().ticks(5);
	bChart.yAxis().tickFormat(d3.format('2s'));

	dc.renderAll();
	</script>

@stop
