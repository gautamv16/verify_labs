<?php

namespace App\Http\Controllers\Admin;

use App\Shipment;
use App\ShipmentTest;
use App\ShipmentTestResult;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $validator = Validator::make($payload, [
            'supervision_location_id' => 'required',
            'lab_id' => 'required',
            'supervision_date' => 'required',
            'uploaded_files' => 'required',
           ],[]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
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
            $validator = Validator::make($payload, [
            'result' => 'required',
            'lab_id' => 'required',
            'testing_date' => 'required',
            'report_upload' => 'required',
           ],[]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
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
            $validator = Validator::make($payload, [
            'importer_id' => 'required',
            'exporter_id' => 'required',
            'uae_firs_number' => 'required',
            'registration_location_id' => 'required',
            'created_date' => 'required'  
           ],[]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $record_id = "SHP-".str_pad(rand(0, pow(10, 5)-1), 5, '0', STR_PAD_LEFT);
            $payload['record_id'] = $record_id; 
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            $payload['qr_code'] = base64_encode($record_id);
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
    public function show($record_id)
    {
        $shipment  = Shipment::where('record_id','=',$record_id)->first(); 
        return view('admin.shipment.show_shipment',compact('shipment'));
    }

    public function shipment_detail($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first(); 
        return view('admin.shipment.shipment_detail',compact('shipment'));
    }

    
}
