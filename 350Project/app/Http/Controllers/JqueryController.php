<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trade;
class JqueryController extends Controller
{
    public function jquery() {
		 return view('JQAjax');
	 }

    public function get(Request $request) {
      //$data = $request->all();
      $data = Trade::where('Reporter',$request->country)->where('Year',$request->year)
      ->where('Commodity',$request->commodity)->where('Partner', 'World')->get();
      return response()->json($data);
      }


   }
