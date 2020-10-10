<?php

namespace App\Http\Controllers\Admin;

use App\Shipment;
use App\ShipmentTest;
use App\ShipmentTestResult;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $shipments = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result')->get();
          return view('admin.shipment.index',compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.shipment.add');
    }


    public function get_step_two($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first();
        return view('admin.shipment.step_two',compact('shipment'));
    }

    public function get_step_three($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first();
        return view('admin.shipment.step_three',compact('shipment'));
    }

    public function step_two(Request $request){
        try{
            $payload = $request->all();
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            $assetPath = "admin/files/testing";
            if($files = $request->file('uploaded_files')){
                $name=$payload['record_id'].".".$files->getClientOriginalExtension();  
                $files->move($assetPath,$name);  
                $payload['uploaded_files']=$name;  
            }
            $step_two = ShipmentTest::create($payload);
            return redirect()->to('/admin/shipments')->with('success','Step two registered successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
        

    }

    public function step_three(Request $request){
        $assetPath = "admin/files/testing_result";
        try{
            $payload = $request->all();
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            if($files = $request->file('report_upload')){
                $name=$payload['record_id'].".".$files->getClientOriginalExtension();  
                $files->move($assetPath,$name);  
                $payload['report_upload']=$name;  
            }
            $step_two = ShipmentTestResult::create($payload);
            return redirect()->to('/admin/shipments')->with('success','Step three registered successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $payload = $request->all();
            $payload['record_id'] = "SHP-".random_int(4, 10);
            $shipment = Shipment::create($payload);
        return redirect()->to('/admin/shipments')->with('success','Register Location created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
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
