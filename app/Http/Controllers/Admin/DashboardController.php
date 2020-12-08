<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;

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
        $shipments = \App\Shipment::with('exporter','shipment_test','shipment_test_result')->whereMonth('created_date', date('m'))->count();
        $importers = \App\Importer::count();
        $exporters = \App\Exporter::count();
        $audited_exporters = \App\Exporter::where('approved_farm','=',1)->count();
        $passed_shipments = 0;
        $audited_shipment = 0;
        $failed_shipments = 0;
        $shipments_waiting_sampling = 0;
        $shipment_waiting_lab = 0;
        if($shipments){
            $shipment_data = \App\Shipment::whereMonth('created_date', date('m'))->get();
            foreach ($shipment_data as $key => $value) {
                if($value->exporter->approved_farm){
                    $audited_shipment = $audited_shipment + 1;
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
        

        return view('admin/dashboard',compact('shipments','importers','exporters','audited_exporters','audited_shipment','failed_shipments','passed_shipments','shipments_waiting_sampling','shipment_waiting_lab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUser $adminUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUser $adminUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminUser $adminUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $adminUser)
    {
        //
    }
}
