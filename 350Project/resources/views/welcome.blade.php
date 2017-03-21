<!DOCTYPE html>
<html>
  <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="http://d3js.org/d3.v3.min.js"></script>
     <style>
     </style>
 </head>

 <body>
    <script>
    var arr = new Array();
    var datasz = <?php echo json_encode($data, JSON_PRETTY_PRINT)?>;
    console.log(datasz);
    console.log(datasz[0].Reporter);
    console.log(datasz.length);
    datasz.splice(0,1);
    for (var i = 0; i < datasz.length; i++) {
      arr.push(datasz[i].Export);
   }
   console.log(arr);

    //Width and height
			var w = 600;
			var h = 250;

			var dataset = [ 5, 10, 13, 19, 21, 25, 22, 18, 15, 13,
							11, 12, 15, 20, 18, 17, 16, 18, 23, 25 ];
         dataset = datasz;
			var xScale = d3.scale.ordinal()
							.domain(d3.range(dataset.length))
							.rangeRoundBands([0, w], 0.05);
			var yScale = d3.scale.linear()
							.domain([0, d3.max(arr)])
							.range([0, h]);

			//Create SVG element
			var svg = d3.select("body")
						.append("svg")
						.attr("width", w)
						.attr("height", h);
			//Create bars
			svg.selectAll("rect")
			   .data(dataset)
			   .enter()
			   .append("rect")
			   .attr("x", function(d, i) {
			   		return xScale(i);
			   })
			   .attr("y", function(d) {
			   		return h - yScale(d.Export);
			   })
			   .attr("width", xScale.rangeBand())
			   .attr("height", function(d) {
			   		return yScale(d.Export);
			   })
			   .attr("fill", function(d) {
					return "rgb(0, 0, " + yScale(d.Export)/2 + ")";
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
			   		return h - yScale(d.Export) + 14;
			   })
			   .attr("font-family", "sans-serif")
			   .attr("font-size", "11px")
			   .attr("fill", "white");

    </script>
    <div></div>
</body>
</html>
