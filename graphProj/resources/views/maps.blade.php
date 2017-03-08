@extends('layout')

@section('content')

<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://d3js.org/topojson.v0.min.js"></script>
<style>
	body {
      background-color: white;
    }
    svg {
    	border: 2px solid black;
    	background-color: #a4bac7;
    }

	.land {
	  fill: #d7c7ad;
	  stroke: #766951;
	}

	.boundary {
	  fill: none;
	  stroke: #a5967e;
	}

	.graticule {
	  fill: none;
	  stroke: #fff;
	  stroke-width: .5px;
	}

	.graticule :nth-child(2n) {
	  stroke-dasharray: 2,2;
	}

</style>
<script src="js/wmap.js"></script>
@stop
