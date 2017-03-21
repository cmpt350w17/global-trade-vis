<script>
var dataz = <?php echo json_encode($data, JSON_PRETTY_PRINT)?>;
console.log(dataz);
console.log(dataz[0].Reporter);
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
 console.log(dataset.length);
 for (var i = 0; i < dataset.length; i++) {
	 arr.push(dataset[i].Export);
 }
 var max = d3.max(arr);
 var halfmax = max/15;
 console.log(max);
 var margin = {top: 20, right: 20, bottom: 70, left: 40};

 var w = 600;
 var h = 300;
 var maxValue = 100;
 var padding = 30;
 //Create SVG element
 var svg = d3.select("body")
				 .append("svg")
				 .attr("width", w)
				 .attr("height", h);

 var xScale = d3.scale.ordinal()
					 .domain(d3.range(dataset.length))
					 .rangeRoundBands([padding, w], 0.05);

 var yScale = d3.scale.linear()
					 .domain([0, d3.max(arr)])
					 .range([padding, h]);
 var xAxis = d3.svg.axis()
					 .scale(xScale)
					 .orient("bottom")
					 .ticks(6);

 var yAxis = d3.svg.axis()
					 .scale(yScale)
					 .orient("left")
					 .ticks(5);

					 svg.selectAll("rect")
						 .data(dataset)
						 .enter()
						 .append("rect")
						 .attr("x", function(d,i) { return xScale(i); })
						 .attr("y", function(d) {
							 return h-yScale(d.Export); })
						 .attr("width", xScale.rangeBand())
						 .attr("height", function(d) { return yScale(d.Export); })
						 .attr("fill", function(d) {
										 return "rgb(0, 0, " + (yScale(d.Export) * 10) + ")";
									 })
						 .on("mouseover", function() {
									 d3.select(this)
									 .attr("fill", "orange");
						  })
						 .on("mouseout", function(d) {
										 d3.select(this)
												 .transition()
												 .duration(250)
											 .attr("fill", "rgb(0, 0, " + (yScale(d.Export) * 10) + ")");
									 });
									 //Create labels
									 svg.selectAll("text")
										 .data(dataset)
										 .enter()
										 .append("text")
										 .text(function(d) {
											return d.Partner;
										 })
										 .attr("text-anchor", "middle")
										 .attr("x", function(d, i) {
											return xScale(i) + xScale.rangeBand() / 2;
										 })
										 .attr("y", function(d) {
											return h - yScale(d.Export) + padding;
										 })
										 .attr("font-family", "sans-serif")
										 .attr("font-size", "11px")
										 .attr("fill", "white");
										 svg.append("g")
											 .attr("class","axis")
											 .attr("transform","translate(0," + (h - padding) + ")")
											 .call(xAxis)

										 svg.append("g")
											 .attr("class", "axis")
											 .attr("transform", "translate(" + padding + ",0)")
											 .call(yAxis);
</script>
