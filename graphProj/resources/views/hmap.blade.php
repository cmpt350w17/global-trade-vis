@extends('layout')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
<script src="js/datamaps.world.min.js"></script>
<div id="container" style="position: relative; width: 900px; height: 500px;"></div>
<script>
    var map = new Datamap({element: document.getElementById('container')});
</script>
@stop
