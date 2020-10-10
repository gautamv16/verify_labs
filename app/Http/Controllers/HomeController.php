<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipment;
use App\ShipmentTest;
use App\ShipmentTestResult;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function search_report(Request $request){
        $fins_number = $request->get('fins_number');
        $shipment = Shipment::where('uae_firs_number','=',$fins_number)->with('importer','exporter','registrationLocation')->with(['shipment_test'=>function($q){
            return $q->with('supervisionLocation','labs');
        }])->with(['shipment_test_result'=>function($q){
            return $q->with('labs');
        }])->first();
        //echo "<pre>"; print_r($shipment); die;
        return view('search_report',compact('shipment'));
    }
}
