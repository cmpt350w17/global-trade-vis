@extends('layouts.master3')
@section('stuff')
<link rel="stylesheet" href="css/centeredMap.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
<script src="js/datamaps.world.min.js"></script>
<script src="js/testarcs.js"></script>
<div id="container" style="position: relative; width: 700px; height: 475px;"></div>
<script>
    var dt = <?php echo json_encode($data)?>;
    console.log(dt);
    for (var i = 0; i < dt.length; i++) {
      var per = dt[i].Export / dt[0].Export;
      console.log(dt[i].Reporter + ": " + dt[i].Export + " " + per);
   }
    var series = [
        ["CHN",100],["USA",66],["DEU",58],["JPN",27],["KOR",23],["FRA",21],
        ["GBR",20],["ITA",20],["CAN",18],["MEX",17],["RUS",15],["IND",12],
        ["SAU",9],["BRA",8],["AUS",8],["ZAF",3],["TUR",6],["IDN",7],
        ["ARG",2]];
        var dataset = {};
        // We need to colorize every country based on "numberOfWhatever"
        // colors should be uniq for every value.
        // For this purpose we create palette(using min/max series-value)
        var onlyValues = series.map(function(obj){ return obj[1]; });
        var minValue = Math.min.apply(null, onlyValues),
                maxValue = Math.max.apply(null, onlyValues);
        // create color palette function
        // color can be whatever you wish
        var paletteScale = d3.scale.linear()
                .domain([minValue,maxValue])
                .range(["#EFEFFF","#02386F"]); // blue color
        // fill dataset in appropriate format
        series.forEach(function(item){ //
            // item example value ["USA", 70]
            var iso = item[0],
                    value = item[1];
            dataset[iso] = { numberOfThings: value, fillColor: paletteScale(value) };
        });


    var map = new Datamap({element: document.getElementById('container'),
    done: function(datamap) {
            datamap.svg.selectAll('.datamaps-subunit').on('click', function(geography) {
                console.log(geography.properties.name);
                if (geography.properties.name == "Canada") {
                   map.arc( Canada, {popupOnHover: true});
                }
                if (geography.properties.name == "United States of America") {
                   map.arc( America, {popupOnHover: true});
                }
                if (geography.properties.name == "China") {
                   map.arc( China, {popupOnHover: true});
                }
                if (geography.properties.name == "Germany") {
                   map.arc( Germany, {popupOnHover: true});
                }
                if (geography.properties.name == "Japan") {
                   map.arc( Japan, {popupOnHover: true});
                }
                if (geography.properties.name == "Mexico") {
                   map.arc( Mexico, {popupOnHover: true});
                }
                if (geography.properties.name == "United Kingdom") {
                   map.arc( UnitedKingdom, {popupOnHover: true});
                }
                if (geography.properties.name == "France") {
                   map.arc( France, {popupOnHover: true});
                }
                if (geography.properties.name == "India") {
                   map.arc( India, {popupOnHover: true});
                }
                if (geography.properties.name == "Brazil") {
                   map.arc( Brazil, {popupOnHover: true});
                }
                if (geography.properties.name == "Italy") {
                   map.arc( Italy, {popupOnHover: true});
                }
                if (geography.properties.name == "Turkey") {
                   map.arc( Turkey, {popupOnHover: true});
                }
                if (geography.properties.name == "Russia") {
                   map.arc( Russia, {popupOnHover: true});
                }
                if (geography.properties.name == "Saudi Arabia") {
                   map.arc( Saudi, {popupOnHover: true});
                }
                if (geography.properties.name == "Australia") {
                   map.arc( Australia, {popupOnHover: true});
                }
                if (geography.properties.name == "South Africa") {
                   map.arc( SAfrica, {popupOnHover: true});
                }
                if (geography.properties.name == "Indonesia") {
                   map.arc( Indonesia, {popupOnHover: true});
                }
                if (geography.properties.name == "Argentina") {
                   map.arc( Argentina, {popupOnHover: true});
                }
                if (geography.properties.name == "South Korea") {
                   map.arc( Korea, {popupOnHover: true});
                }



                /*if (geography.properties.name == "Greenland") {
                   map.svg.selectAll('path.datamaps-arc').remove();
                }*/


            });
        },
    projection: 'mercator',
    fills: {
    defaultFill: "#F5F5F5" },
    data: dataset,
    geographyConfig: {
        borderColor: '#DEDEDE',
        highlightBorderWidth: 2,
        // don't change color on mouse hover
        highlightFillColor: function(geo) {
            return geo['fillColor'] || '#F5F5F5';
        },
        // only change border
        highlightBorderColor: '#B7B7B7',
        
        // show desired information in tooltip
        popupTemplate: function(geo, data) {
            // don't show tooltip if country don't present in dataset
            if (!data) { return ; }
            // tooltip content
            return ['<div class="hoverinfo">',
                '<strong>', geo.properties.name, '</strong>',
                '<br>Count: <strong>', data.numberOfThings, '</strong>',
                '</div>'].join('');
        }
    }

});






 </script>
@stop
@section('content')
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
		<!--<div class="form-group">
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
	 	</div>-->
	</form>
</div>
@stop
