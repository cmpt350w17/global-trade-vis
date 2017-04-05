@extends('layouts.master3')
@section('stuff')
<link rel="stylesheet" href="css/centeredMap.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
<script src="js/datamaps.world.min.js"></script>
<script src="js/testarcs.js"></script>
<div id="container" style="position: relative; width: 700px; height: 475px;"></div>
<style>
.datamaps-legend {
    color: blue;
	 margin-top: 0px;
    right: -100px;
    top: 0;
    position: relative;
    display: inline-block;
    text-align: center;
 }

.datamaps-legend dl {
  text-align: center;
  display: inline-block;
  position: static;
}
</style>
<script>
	function Zoom(args) {
	  $.extend(this, {
	    $buttons:   $(".zoom-button"),
	    $info:      $("#zoom-info"),
	    scale:      { max: 50, currentShift: 0 },
	    $container: args.$container,
	    datamap:    args.datamap
	  });
	  this.init();
	}
	Zoom.prototype.init = function() {
	  var paths = this.datamap.svg.selectAll("path"),
	      subunits = this.datamap.svg.selectAll(".datamaps-subunit");
	  // preserve stroke thickness
	  paths.style("vector-effect", "non-scaling-stroke");
	  // disable click on drag end
	  subunits.call(
	    d3.behavior.drag().on("dragend", function() {
	      d3.event.sourceEvent.stopPropagation();
	    })
	  );
	  this.scale.set = this._getScalesArray();
	  this.d3Zoom = d3.behavior.zoom().scaleExtent([ 1, this.scale.max ]);
	  this._displayPercentage(1);
	  this.listen();
	};
	Zoom.prototype.listen = function() {
	  this.$buttons.off("click").on("click", this._handleClick.bind(this));
	  this.datamap.svg
	    .call(this.d3Zoom.on("zoom", this._handleScroll.bind(this)))
	    .on("dblclick.zoom", null); // disable zoom on double-click
	};
	Zoom.prototype.reset = function() {
	  this._shift("reset");
	};
	Zoom.prototype._handleScroll = function() {
	  var translate = d3.event.translate,
	      scale = d3.event.scale,
	      limited = this._bound(translate, scale);
	  this.scrolled = true;
	  this._update(limited.translate, limited.scale);
	};
	Zoom.prototype._handleClick = function(event) {
	  var direction = $(event.target).data("zoom");
	  this._shift(direction);
	};
	Zoom.prototype._shift = function(direction) {
	  var center = [ this.$container.width() / 2, this.$container.height() / 2 ],
	      translate = this.d3Zoom.translate(), translate0 = [], l = [],
	      view = {
	        x: translate[0],
	        y: translate[1],
	        k: this.d3Zoom.scale()
	      }, bounded;
	  translate0 = [
	    (center[0] - view.x) / view.k,
	    (center[1] - view.y) / view.k
	  ];
		if (direction == "reset") {
	  	view.k = 1;
	    this.scrolled = true;
	  } else {
	  	view.k = this._getNextScale(direction);
	  }
	l = [ translate0[0] * view.k + view.x, translate0[1] * view.k + view.y ];
	  view.x += center[0] - l[0];
	  view.y += center[1] - l[1];
	  bounded = this._bound([ view.x, view.y ], view.k);
	  this._animate(bounded.translate, bounded.scale);
	};
	Zoom.prototype._bound = function(translate, scale) {
	  var width = this.$container.width(),
	      height = this.$container.height();
	  translate[0] = Math.min(
	    (width / height)  * (scale - 1),
	    Math.max( width * (1 - scale), translate[0] )
	  );
	  translate[1] = Math.min(0, Math.max(height * (1 - scale), translate[1]));
	  return { translate: translate, scale: scale };
	};
	Zoom.prototype._update = function(translate, scale) {
	  this.d3Zoom
	    .translate(translate)
	    .scale(scale);
	  this.datamap.svg.selectAll("g")
	    .attr("transform", "translate(" + translate + ")scale(" + scale + ")");
	  this._displayPercentage(scale);
	};
	Zoom.prototype._animate = function(translate, scale) {
	  var _this = this,
	      d3Zoom = this.d3Zoom;
	  d3.transition().duration(350).tween("zoom", function() {
	    var iTranslate = d3.interpolate(d3Zoom.translate(), translate),
	        iScale = d3.interpolate(d3Zoom.scale(), scale);
			return function(t) {
	      _this._update(iTranslate(t), iScale(t));
	    };
	  });
	};
	Zoom.prototype._displayPercentage = function(scale) {
	  var value;
	  value = Math.round(Math.log(scale) / Math.log(this.scale.max) * 100);
	  this.$info.text(value + "%");
	};
	Zoom.prototype._getScalesArray = function() {
	  	var array = [],
	      	scaleMaxLog = Math.log(this.scale.max);
	  	for (var i = 0; i <= 10; i++) {
	    	array.push(Math.pow(Math.E, 0.1 * i * scaleMaxLog));
	  	}
  		return array;
	};
	Zoom.prototype._getNextScale = function(direction) {
		var scaleSet = this.scale.set,
	      	currentScale = this.d3Zoom.scale(),
	      	lastShift = scaleSet.length - 1,
	      	shift, temp = [];
	  	if (this.scrolled) {
		    for (shift = 0; shift <= lastShift; shift++) {
		      temp.push(Math.abs(scaleSet[shift] - currentScale));
		    }
		    shift = temp.indexOf(Math.min.apply(null, temp));
		    if (currentScale >= scaleSet[shift] && shift < lastShift) {
		      shift++;
		    }
		    if (direction == "out" && shift > 0) {
		      shift--;
		    }
		    this.scrolled = false;
		  } else {
		    shift = this.scale.currentShift;
		    if (direction == "out") {
		      shift > 0 && shift--;
		    } else {
		      shift < lastShift && shift++;
		    }
		  }
		  this.scale.currentShift = shift;
		  return scaleSet[shift];
	};
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
        ["ARG",2], ["ESP",12],["ISR",3],["GRC",1], ["NZL",1.5],["DZA",1.5],["COL",1.5],["NGA",4.5]];
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
        series.forEach(function(item) { //
            // item example value ["USA", 70]
            var iso = item[0],
                    value = item[1];
            dataset[iso] = { numberOfThings: value, fillColor: paletteScale(value) };
        });
		  var legend_params = {
    			legendTitle: "Ratio to largest exporter",
  		};

    function Datamap(){
    	this.$container = $("#container");
    	this.instance = new Datamaps({
    		scope:'world',
    		element:this.$container.get(0),
	    	projection: 'mercator',
		    fills: {
				 "< 10%": "#ccccff",
	          "10-20%": "#9999ff",
	          "30-50%": "#6666ff",
	          "50-70%": "#3333ff",
	          "90-100%": "#02386F",

		    defaultFill: "#F5F5F5" },
		    data: dataset,
		    geographyConfig: {
		        borderColor: '#b3b3b3',
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
		            if (data) { return ['<div class="hoverinfo">',
		                '<strong>', geo.properties.name, '</strong>',
		                '<br>Export percentage <br>relative to world leader: <strong>', data.numberOfThings,'%</strong>',
		                '</div>'].join(''); }
		            else {
		            	 return ['<div class="hoverinfo">',
		                '<strong>', geo.properties.name, '</strong></div>'].join('');
		            }
				 }
		    },

    		done: this._handleMapReady.bind(this)
		});
		var map = this.instance;
		map.legend(legend_params);

	}
	Datamap.prototype._handleMapReady = function(datamap) {
		datamap.svg.selectAll('.datamaps-subunit').on('click', function(geography) {
                console.log(geography.properties.name);
                if (geography.properties.name == "Canada") {
                   datamap.arc( Canada, {popupOnHover: true});
                }
                else if (geography.properties.name == "United States of America") {
                   datamap.arc( America, {popupOnHover: true});
                }
                else if (geography.properties.name == "China") {
                   datamap.arc( China, {popupOnHover: true});
                }
                else if (geography.properties.name == "Germany") {
                   datamap.arc( Germany, {popupOnHover: true});
                }
                else if (geography.properties.name == "Japan") {
                   datamap.arc( Japan, {popupOnHover: true});
                }
                else if (geography.properties.name == "Mexico") {
                   datamap.arc( Mexico, {popupOnHover: true});
                }
                else if (geography.properties.name == "United Kingdom") {
                   datamap.arc( UnitedKingdom, {popupOnHover: true});
                }
                else if (geography.properties.name == "France") {
                   datamap.arc( France, {popupOnHover: true});
                }
     				 else if (geography.properties.name == "India") {
                   datamap.arc( India, {popupOnHover: true});
                }
                else if (geography.properties.name == "Brazil") {
                   datamap.arc( Brazil, {popupOnHover: true});
                }
                else if (geography.properties.name == "Italy") {
                   datamap.arc( Italy, {popupOnHover: true});
                }
                else if (geography.properties.name == "Turkey") {
                   datamap.arc( Turkey, {popupOnHover: true});
                }
                else if (geography.properties.name == "Russia") {
                   datamap.arc( Russia, {popupOnHover: true});
                }
                else if (geography.properties.name == "Saudi Arabia") {
                   datamap.arc( Saudi, {popupOnHover: true});
                }
                else if (geography.properties.name == "Australia") {
                   datamap.arc( Australia, {popupOnHover: true});
                }
                else if (geography.properties.name == "South Africa") {
                   datamap.arc( SAfrica, {popupOnHover: true});
                }
                else if (geography.properties.name == "Indonesia") {
                   datamap.arc( Indonesia, {popupOnHover: true});
                }
                else if (geography.properties.name == "Argentina") {
                   datamap.arc( Argentina, {popupOnHover: true});
                }
                else if (geography.properties.name == "South Korea") {
                   datamap.arc( Korea, {popupOnHover: true});
                }
                else if (geography.properties.name == "Spain") {
                	datamap.arc(Spain, {popupOnHover: true});
                }
                else if (geography.properties.name == "Israel") {
                	datamap.arc(Israel, {popupOnHover: true});
                }
                else if (geography.properties.name == "Greece") {
                	datamap.arc(Greece, {popupOnHover: true});
                }
                else if (geography.properties.name == "New Zealand") {
                	datamap.arc(NewZealand, {popupOnHover: true});
                }
                else if (geography.properties.name == "Algeria") {
                	datamap.arc(Algeria, {popupOnHover: true});
                }
                else if (geography.properties.name == "Colombia") {
                	datamap.arc(Colombia, {popupOnHover: true});
                }
                else if (geography.properties.name == "Nigeria") {
                	datamap.arc(Nigeria, {popupOnHover: true});
                }
            })
		document.getElementById("clearbutton").onclick=function(){
	 		datamap.svg.selectAll('path.datamaps-arc').remove();
		}
		this.zoom = new Zoom({
  			$container: this.$container,
  			datamap: datamap
  		});


	}

    new Datamap();
 </script>
@stop
@section('content')
<div class="w3-sidebar w3-light-grey w3-bar-block" id="sidebar">
	<h4 class="w3-bar-item" style="margin-left: 20px">Map Controls</h4>
	<div id="zoom-controls">
		<button class="zoom-button" data-zoom="out" style="margin: 2px">-</button>
		<button class="zoom-button" data-zoom="reset" style="margin: 2px">0</button>
		<button class="zoom-button" data-zoom="in" style="margin: 2px">+</button>
		<div id="zoom-info"></div>
	</div>
	<button type="button" style="margin-left: 52px " id="clearbutton">Clear Map</button>
 </div>

@stop
