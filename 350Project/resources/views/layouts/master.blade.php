<!DOCTYPE html>
<html>
<style>
#hello {
	width: 300px;
	margin: 15px;
	margin-top: 1px;
}
.custom-select {
   width: 200px;
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQRangeSlider/5.7.2/css/iThing.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>

    <body>

        <div class="pic">



        </div>

        <nav class="navbar navbar-default" >
          <div class="container-fluid" >
            <div class="navbar-header">

            </div>
            <ul class="nav navbar-nav">
              <li> <a href="/">Map View</a></li>
              <li><a href="bars">Bar view</a></li>

              <li><a href="lines">Line view</a></li>
              <li><a href="disc">Disc view</a></li>

            </ul>


	</body>
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
      <option selected id="9">Choose...</option>
      <option value="Dayforce" id="1">Canada</option>
      <option value="iNovah" id="2">USA</option>
      <option value="LibraryOnline" id="3">Japan</option>
      <option value="PeopleSoft" id="4">China</option>
      <option value="SAP" id="5">India</option>
      <option value="StaffWeb" id="6">UK</option>
      <option value="Workflows" id="7">France</option>
      <option value="Other" id="8">Brazil</option>
    </select>
  </div>
  <div class="form-group">

  <label class="col-md-4 control-label" for="formCustomSelect" id="drop">Commodity</label>
  <select name="system1" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="frm">
     <option selected id="9">Choose...</option>
     <option value="Dayforce" id="1">Canada</option>
     <option value="iNovah" id="2">USA</option>
     <option value="LibraryOnline" id="3">Japan</option>
     <option value="PeopleSoft" id="4">China</option>
     <option value="SAP" id="5">India</option>
     <option value="StaffWeb" id="6">UK</option>
     <option value="Workflows" id="7">France</option>
     <option value="Other" id="8">Brazil</option>
  </select>
  <div class="form-group" id="slider">
    <input id="test" type="range"/>
  </div>


</div>
</form>
</div>
</div>
</div>
