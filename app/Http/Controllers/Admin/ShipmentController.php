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
        $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
        $shipments = [];
        if(count($shipments_data) > 0){
          foreach($shipments_data as $k=>$d){
                  if($d->exporter->approved_farm){
                      $shipments[] = $d;
                  }elseif($d->shipment_test && $d->shipment_test_result && $d->shipment_test_result->result == 1){
                      $shipments[] = $d;
                  }
          }
        }
          return view('admin.shipment.index',compact('shipments'));
    }

    public function failed_shipments(){
        $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
        $failed_shipments = [];
        if(count($shipments_data) > 0){
          foreach($shipments_data as $k=>$d){
                  if($d->shipment_test && $d->shipment_test_result && $d->shipment_test_result->result != 1){
                      $failed_shipments[] = $d;
                  }
          }
        }
        return view('admin.shipment.failed_shipments',compact('failed_shipments'));
    }

    public function pending_shipments(){
        $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
        $sampling_shipments = [];
        $test_shipments = [];
        if(count($shipments_data) > 0){
          foreach($shipments_data as $k=>$d){
                  if(!$d->shipment_test && !$d->exporter->approved_farm){
                      $sampling_shipments[] = $d;
                  }                  
                  if($d->shipment_test && !$d->shipment_test_result && !$d->exporter->approved_farm){
                      $test_shipments[] = $d;
                  }
          }
        }
        return view('admin.shipment.pending_shipments',compact('sampling_shipments','test_shipments'));
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
            'samples_collected' => 'required',
            'inspection_checklist' => 'required',
           ],[]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            $inspection_checklist= $payload['inspection_checklist'];
            if(count($inspection_checklist) > 0){
                $payload['inspection_checklist'] = implode(",",$inspection_checklist);
            }
            $assetPath = "admin/files/testing";
            $uploaded_files='';
            if ($request->hasfile('uploaded_files')) {
                foreach ($request->file('uploaded_files') as $key=>$file) {
                    $name=$payload['record_id']."_".($key+1).".".$file->getClientOriginalExtension();
                    $file->move($assetPath,$name); 
                    if($uploaded_files == ''){
                        $uploaded_files = $name;
                    }else{
                        $uploaded_files = $uploaded_files.",".$name;
                    }
                }
                $payload['uploaded_files']=$uploaded_files;
            }
          
              $step_two = ShipmentTest::create($payload);
            return redirect()->to('/admin/pending_shipments')->with('success','Step two registered successfully!');
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
            'port_id' => 'required',
            'uploaded_invoices' => 'required',
            'uploaded_packaging_list' => 'required',
            'created_date' => 'required'  
           ],[]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $record_id = "SHP-".str_pad(rand(0, pow(10, 5)-1), 5, '0', STR_PAD_LEFT);
            $payload['record_id'] = $record_id; 
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            $payload['qr_code'] = base64_encode($record_id);
            $assetPath = "admin/files/shipment";
            $uploaded_invoices='';
            if ($request->hasfile('uploaded_invoices')) {
                foreach ($request->file('uploaded_invoices') as $key=>$file) {
                    $name=$payload['record_id']."_".($key+1).".".$file->getClientOriginalExtension();
                    $file->move($assetPath,$name); 
                    if($uploaded_invoices == ''){
                        $uploaded_invoices = $name;
                    }else{
                        $uploaded_invoices = $uploaded_invoices.",".$name;
                    }
                }
                $payload['uploaded_invoices']=$uploaded_invoices;
            }
            $uploaded_packaging_list='';
            if ($request->hasfile('uploaded_packaging_list')) {
                foreach ($request->file('uploaded_packaging_list') as $key=>$file) {
                    $name=$payload['record_id']."_".($key+1).".".$file->getClientOriginalExtension();
                    $file->move($assetPath,$name); 
                    if($uploaded_packaging_list == ''){
                        $uploaded_packaging_list = $name;
                    }else{
                        $uploaded_packaging_list = $uploaded_packaging_list.",".$name;
                    }
                }
                $payload['uploaded_packaging_list']=$uploaded_packaging_list;
            }
            $shipment = Shipment::create($payload);
        return redirect()->to('/admin/pending_shipments')->with('success','Shipment created successfully!');
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
