<?php

namespace App\Http\Controllers\Customer;

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
        $shipments_for_location = \App\Shipment::with('exporter','shipment_user','shipment_test','shipment_test_result')->where('user_id','=',$user->id)->get();
        $passed_shipments = 0;
        $pending_shipment = 0;
        $failed_shipments = 0;
        $shipments_waiting_sampling = 0;
        $shipment_waiting_lab = 0;
        $shipments = [];
        if($shipments_for_location && count($shipments_for_location) > 0){
            foreach($shipments_for_location as $k=>$d){
                if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                    $shipments[] = $d;
                }   
            }
        }
        if($shipments && count($shipments) > 0){
            $shipment_data = \App\Shipment::with(['shipment_user'])->where('user_id','=',$user->id)->get();
            foreach ($shipment_data as $key => $value) {
                if($value->shipment_user && $value->shipment_user->office_location->id == $user_location->id){
                        if($value->exporter->approved_farm){
                             $passed_shipments = $passed_shipments + 1;
                        }

                        if(!$value->shipment_test && !$value->exporter->approved_farm){
                            $shipments_waiting_sampling = $shipments_waiting_sampling + 1;
                        }
                        if($value->shipment_test && !$value->shipment_test_result && !$value->exporter->approved_farm){
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
            $pending_shipment = $shipment_waiting_lab + $shipments_waiting_sampling;
        }
        

        return view('customer/dashboard',compact('user','shipments','pending_shipment','failed_shipments','passed_shipments','shipments_waiting_sampling','shipment_waiting_lab'));
    }

    
}
