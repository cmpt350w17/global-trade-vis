var width = 960,
		    height = 480;

		var svg = d3.select("body").append("svg")
		    .attr("width", width)
		    .attr("height", height);

		var projection = d3.geo.equirectangular()
			.scale(153)
		    .translate([width/2,height/2])


		var path = d3.geo.path()
		    .projection(projection);

		var graticule = d3.geo.graticule();

		d3.json("https://gist.githubusercontent.com/abenrob/787723ca91772591b47e/raw/8a7f176072d508218e120773943b595c998991be/world-50m.json", function(error, world) {
		  	svg.append("g")
		  		.attr("class", "land")
				.selectAll("path")
		  		.data([topojson.object(world, world.objects.land)])
			    .enter().append("path")
			    .attr("d", path);
			svg.append("g")
		  		.attr("class", "boundary")
				.selectAll("boundary")
		  		.data([topojson.object(world, world.objects.countries)])
			    .enter().append("path")
			    .attr("d", path);
			svg.append("g")
				.attr("class", "graticule")
				.selectAll("path")
				.data(graticule.lines)
				.enter().append("path")
				.attr("d", path);
		});
