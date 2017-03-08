<?php

namespace App\Http\Controllers;

use App\Coord;
use Illuminate\Http\Request;

class dController extends Controller
{
    public function home() {
		 $coords = Coord::all();
       //return $data;
		 return view('graph',compact('coords'));
	 }
    public function test() {
      $coords = Coord::all();
      return view('test',compact('coords'));
   }
   public function trans() {
      return view('transition');
   }
   public function maps() {
      return view('hmap');
   }

   public function usmap() {
      return view('USmap');
   }
}
