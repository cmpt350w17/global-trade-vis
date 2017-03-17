<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JqueryController extends Controller
{
    public function jquery() {
		 return view('JQAjax');
	 }
    public function post(Request $request) {
      if($request->ajax()) {
         return $request->all();

      }


   }
}
