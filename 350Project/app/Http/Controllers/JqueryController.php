<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trade;
class JqueryController extends Controller
{
    public function jquery() {
      $data = Trade::select('Reporter', 'Partner', 'Year', 'Export', 'Commodity','Import')
      ->where('Reporter', '=','Canada')
      ->where('Commodity', '=', 'All Commodities')->where('Year', '=', '2015')
      ->orderBy ('Export', 'DESC')->take (11)->get();
		 return view('map',compact('data'));
	 }

    public function get(Request $request) {
      //$data = $request->all();
      $data = Trade::select('Reporter', 'Partner', 'Year', 'Export', 'Commodity','Import')
      ->where('Reporter', '=',$request->country)
      ->where('Commodity', '=', $request->commodity)->where('Year', '=', $request->year)
      ->orderBy ('Export', 'DESC')->take (11)->get();
      /*$data = Trade::where('Year',$request->year)->where('Commodity',$request->commodity)->where('Reporter',$request->country)
      ->orderBy('Export','DESC')->take(11)->get();*/

      return response()->json($data);
      /**$data = Trade::where('Reporter',$request->country)->where('Year',$request->year)
      ->where('Commodity',$request->commodity)->where('Partner', 'World')->get();
      return response()->json($data);
      }
      **/

   }

}
