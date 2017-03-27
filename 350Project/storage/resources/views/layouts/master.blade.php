<!DOCTYPE html>
<html>
<style>
#hello {
	width: 250px;

	margin: -10px;
	margin-top: -5px;
}
.custom-select {
   width: 175px;
}
#slider {
   margin-top: 20px;
}
</style>

    <head>
        <title>Global Trade Vis</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">

    </head>


		 <nav class="navbar navbar-default" >
          <div class="container-fluid" >
            <div class="navbar-header"></div>
            <ul class="nav navbar-nav">
              <li> <a href="/">Map View</a></li>
              <li><a href="bars">Bar view</a></li>

              <li><a href="lines">Line view</a></li>
              <li><a href="disc">Disc view</a></li>

            </ul>
			</div>
</nav>

<div class="col-md-8 col-md-offset-2" id="hello">
  <div class="panel panel-default">
  <div class="panel-heading">control panel</div>
  <div class="panel-body">
<form>
   <div class="form-group">

    <label class="col-md-4 control-label" for="formCustomSelect" id="drop">Country</label>
    <select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="frm">
      <option selected>Choose...</option>
      <option value="Dayforce">Canada</option>
      <option value="iNovah">USA</option>
      <option value="LibraryOnline">Japan</option>
      <option value="PeopleSoft">China</option>
      <option value="SAP">India</option>
      <option value="StaffWeb">UK</option>
      <option value="Workflows">France</option>
      <option value="Other">Brazil</option>
    </select>
  </div>
  <div class="form-group">

  <label class="col-md-4 control-label" for="formCustomSelect" id="drop">Commodity</label>
  <select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="frm">
     <option selected>Choose...</option>
     <option value="Dayforce">Canada</option>
     <option value="iNovah">USA</option>
     <option value="LibraryOnline">Japan</option>
     <option value="PeopleSoft">China</option>
     <option value="SAP">India</option>
     <option value="StaffWeb">UK</option>
     <option value="Workflows">France</option>
     <option value="Other">Brazil</option>
  </select>
 </div>
<div class="form-group" id="slider">
  <input id="test" type="range"/>
</div>
</form>
</div>
</div>
</div>
