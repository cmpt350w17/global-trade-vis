@extends('layouts.master')

@section('content')
<form>
 <div class="panel panel-default">
   <div class="panel-heading">control panel</div>
	  <div class="panel-body">
 <div class="col-md-8 col-md-offset-2">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
</div>
</div>
@stop
