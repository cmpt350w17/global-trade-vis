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
div.test {
	position: absolute;
	top: -200px;
	margin: 300px;
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
</head>
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
	var country = 'Canada';
	var commodity = 'All Commodities';
	var year = '2015';


	$("#drop").click(function() {
		country = $("#drop").val();
		 if (country != "Choose...") {
			 //console.log(country);
			 $.ajax({
				 type: 'GET',
				 url: '{!!URL::to('ajaxget')!!}',
				 data: { 'country': country, 'commodity': commodity, 'year': year},
				 success: function(data) {
					 console.log('success');
					 for (var i = 0; i < 11; i++) {
					 	console.log(data[i].Partner + ": " + data[i].Export);
				 	 }


			}});
		 }
	 });
	$("#drop2").click(function() {
		 commodity = $("#drop2").val();
		 if (commodity != "Choose...") {
			  //console.log(commodity);
			  $.ajax({
 				 type: 'GET',
 				 url: '{!!URL::to('ajaxget')!!}',
 				 data: { 'country': country, 'commodity': commodity, 'year': year},
 				 success: function(data) {
 					 console.log('success');
 					 console.log(data);
 					 //$("#jqoutput").html(result);
 			}});
		 }

	});
	$("#drop3").click(function() {
		year = $("#drop3").val();
		if (year != "Choose...") {
			//console.log(year);
			$.ajax({
			   type: 'GET',
			   url: '{!!URL::to('ajaxget')!!}',
			   data: { 'country': country, 'commodity': commodity, 'year': year},
			   success: function(data) {
					console.log('success');
					console.log(data);
					//$("#jqoutput").html(result);
		  }});
		}
	});
	//var dataString = country . " " . commodity . " " . year;

	/**$.ajax({
      type: 'POST',
      url: '/ajaxpost',
      data: dataString,
      success: function(){ // What to do if we succeed
        alert("DATA SENT!");

      }
    })
   **/
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
		</ul>
	</div>
</nav>

<body>
	<!-- Sidebar -->
	<div class="w3-sidebar w3-light-grey w3-bar-block" id="sidebar">
  		<h4 class="w3-bar-item">Global Trade Vis</h4>
	<form method="GET" id="frm">
		<meta name="csrf-token" content="{{ csrf_token() }}"/>
		<div class="form-group">
		 <label class="col-md-4 control-label">Country</label>
	    <select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop">
	      <option selected>Choose...</option>
	      <option value="Canada">Canada</option>
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
	     <option selected>Choose...</option>
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
		  <option value="All Commodities">All Commodities</option>
	  </select>
  </div>

	  <div class="form-group">
		  <label class="col-md-4 control-label">Year</label>
	  	  <select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="drop3">
	     	 <option selected>Choose...</option>
	     	 <option value="1997">1997</option>
	     	 <option value="2000">2000</option>
	     	 <option value="2003">2003</option>
	     	 <option value="2006">2006</option>
	     	 <option value="2009">2009</option>
	     	 <option value="2011">2011</option>
	     	 <option value="2012">2012</option>
	     	 <option value="2013">2013</option>
			 <option value="2014">2014</option>
			 <option value="2015">2015</option>
	  	 </select>
	 </div>
 </form>
 </div>
 <div class="test">
	 @yield('content')
</div>
</body>
</html>
