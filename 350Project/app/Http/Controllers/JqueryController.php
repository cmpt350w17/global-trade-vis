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
      $data = Trade::select('Reporter', 'Partner', 'Year', 'Export', 'Commodity')->where('Reporter', '=',$request->country)->where('Commodity', '=', $request->commodity)->where('Year', '=', $request->year)->orderBy ('Export', 'DESC')->take (11)->get();

      /*Trade::where('Reporter',$request->country)->where('Year',$request->year)
      ->where('Commodity',$request->commodity)->where('Partner', 'World')->get();*/
      return response()->json($data);
      }


   }
