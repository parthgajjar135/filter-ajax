<?php

namespace App\Http\Controllers;

use App\purchase_inward;
use DB;
use Illuminate\Http\Request;

class PurchaseInwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if(request()->ajax())
     {
      if(!empty($request->from_date))
      {
       $data = DB::table('purchase_inwards')
         ->whereBetween('buyer_order_date', array($request->from_date, $request->to_date))
         ->get();
      }
      else
      {
       $data = DB::table('purchase_inwards')
         ->get();
      }
      return datatables()->of($data)->make(true);
     }
     return view('purchase_inward_datatable');
    }
    

    
   
 
  
    
}
