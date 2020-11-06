<?php

namespace App\Http\Controllers\LabUser;

use App\AdminUser;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('admins')->user();
        $user_location = $user->office_location;
        $shipments = \App\Shipment::with('exporter','shipment_user','shipment_test','shipment_test_result')->whereMonth('created_date', date('m'))->count();
        $audited_exporters = \App\Exporter::where('approved_farm','=',1)->count();
        $passed_shipments = 0;
        $audited_shipment = 0;
        $failed_shipments = 0;
        $shipments_waiting_sampling = 0;
        $shipment_waiting_lab = 0;
        if($shipments){
            $shipment_data = \App\Shipment::with('shipment_user')->whereMonth('created_date', date('m'))->get();
            foreach ($shipment_data as $key => $value) {
                if($value->shipment_user->office_location->id == $user_location->id){
                        if($value->exporter->approved_farm){
                             $audited_shipment = $audited_shipment + 1;
                        }

                        if(!$value->shipment_test){
                            $shipments_waiting_sampling = $shipments_waiting_sampling + 1;
                        }
                        if(!$value->shipment_test_result){
                            $shipment_waiting_lab = $shipment_waiting_lab + 1;
                        }
                        if( $value->shipment_test && $value->shipment_test_result){
                            if($value->shipment_test_result->result == 1){
                                $passed_shipments = $passed_shipments + 1;
                            }
                            if($value->shipment_test_result->result == 0){
                                $failed_shipments = $failed_shipments + 1;
                            }
                        }
                }
                
            }
        }
        

        return view('labuser/dashboard',compact('user','shipments','audited_exporters','audited_shipment','failed_shipments','passed_shipments','shipments_waiting_sampling','shipment_waiting_lab'));
    }

    
}
