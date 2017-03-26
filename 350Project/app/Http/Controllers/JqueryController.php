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
		 return view('bars2',compact('data'));
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
   public function showlines() {
      $data = Trade::select('Reporter', 'Partner', 'Year', 'Export', 'Commodity','Import')
     ->where('Reporter', '=',"Canada")
     ->where('Commodity', '=', "All Commodities")->where('Partner', '=', "India")
     ->orderBy('Year')->get();

     return view('lines', compact('data'));

  }
   public function linesget(Request $request) {
     //$data = $request->all();
     $data = Trade::select('Reporter', 'Partner', 'Year', 'Export', 'Commodity','Import')
     ->where('Reporter', '=',$request->Exporter)
     ->where('Commodity', '=', $request->Commodity)->where('Partner', '=', $request->Importer)
     ->orderBy('Year')->get();
     /*$data = Trade::where('Year',$request->year)->where('Commodity',$request->commodity)->where('Reporter',$request->country)
     ->orderBy('Export','DESC')->take(11)->get();*/

     return response()->json($data);
     /**$data = Trade::where('Reporter',$request->country)->where('Year',$request->year)
     ->where('Commodity',$request->commodity)->where('Partner', 'World')->get();
     return response()->json($data);
     }
     **/

  }
   public function barsQuery() {


      $data = Trade::where('Reporter', '=', 'Greece')->where('Partner', '!=', 'World')->groupBy('Commodity')
      ->selectRaw('Commodity, sum(Export) as total')->get();
		 return view('bars',compact('data'));
    }

    public function sampleQuery() {

      $data = Trade::select('Commodity','Export')->where('Reporter','Greece')->where('Partner','Germany')
      ->where('Year', '2015')->where('Commodity', '!=', 'All Commodities')->orderBy('Year','DESC')
      ->orderBy('Commodity')->get();
      return view('samplequery',compact('data'));
   }

   public function testQuery() {

      $data = Trade::where('Reporter', 'Canada')->where('Year','2015')->where('Commodity','All Commodities')->get();
     return view('testdc',compact('data'));
  }

}
