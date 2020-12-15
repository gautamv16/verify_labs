<?php

namespace App\Http\Controllers\Customer;

use App\Shipment;
use App\ShipmentTest;
use App\ShipmentTestResult;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exporter;
use App\Importer;

class ShipmentController extends Controller
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
          $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
          $shipments = [];
          if(count($shipments_data) > 0){
            foreach($shipments_data as $k=>$d){
                if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                    if($d->exporter->approved_farm){
                        $shipments[] = $d;
                    }elseif($d->shipment_test && $d->shipment_test_result && $d->shipment_test_result->result == 1){
                        $shipments[] = $d;
                    }

                    
                }
            }
          }
          return view('customer.shipment.index',compact('shipments'));
    }

    public function failed_shipments(){
        $user = Auth::guard('admins')->user();
         $user_location = $user->office_location;
          $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
          $failed_shipments = [];
          if(count($shipments_data) > 0){
            foreach($shipments_data as $k=>$d){
                if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                    if($d->shipment_test && $d->shipment_test_result && $d->shipment_test_result->result != 1){
                        $failed_shipments[] = $d;
                    }
                }
            }
          }
          return view('customer.shipment.failed_shipments',compact('failed_shipments'));
    }

    public function pending_shipments(){
        $user = Auth::guard('admins')->user();
         $user_location = $user->office_location;
          $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
          $sampling_shipments = [];
          $test_shipments = [];
          if(count($shipments_data) > 0){
            foreach($shipments_data as $k=>$d){
                if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                    if(!$d->shipment_test && !$d->exporter->approved_farm){
                        $sampling_shipments[] = $d;

                    }
                    
                    if($d->shipment_test && !$d->shipment_test_result && !$d->exporter->approved_farm){
                        $test_shipments[] = $d;
                    }
                }
            }
          }
          return view('customer.shipment.pending_shipments',compact('sampling_shipments','test_shipments'));
    }

    public function searchShipments(Request $request){
        $text = $request->input('text');
        $user = Auth::guard('admins')->user();
        $shipments = [];
         $html = "";
        $user_location = $user->office_location;
        if($text =='' || trim($text) == ''){
            $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
            if(count($shipments_data) > 0){
              foreach($shipments_data as $k=>$d){
                  if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                      $shipments[] = $d;
                  }
              }
            }
          $html.=' <div class="card-body col-md-3">
            <a href="'.route('lab.getaddshipment').'">
             <div class="info mb-2">New</div>
            <div class="lineA mb-2"></div>
            <div class="lineA mb-2"></div>
            <div class="lineB mb-2"></div>
        </a>           
        </div>';
        }else{
          $shipments_data = Shipment::where('uae_firs_number','LIKE',$text)->orWhere('record_id','LIKE',$text)->with('importer','exporter','registrationLocation')->with(['shipment_test'=>function($q){
            return $q->with('supervisionLocation','labs');
        }])->with(['shipment_test_result'=>function($q){
            return $q->with('labs');
        }])->get();
          if(count($shipments_data) > 0){
                foreach($shipments_data as $k=>$d){
                    if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                        $shipments[] = $d;
                    }
                }
              }
        }
        

        if($shipments && count($shipments) > 0){
           
            foreach($shipments as $k=>$shipment){
              $html.='<div class="card-body col-md-3">';
            $html.='<div class="innerBody">';
            $html.='<div class="info mb-2"><a href="'.route('lab.shipment.show',['id'=>$shipment->record_id]).'">'.$shipment->record_id.'</a></div>';
            $html.='<ul class="cardUL">';
            $html.='<li>Loction: <span>'.$shipment->registrationLocation->name.'</span></li>';
            $html.='<li>Date: <span>'.$shipment->created_date.'</span></li>';
            $html.='<li>Importer: <span>'.$shipment->importer->name.'</span></li>';
            $html.='<li>Exporter:<span>'.$shipment->exporter->name.'</span></li>';
            $html.='<li>FINS NO: <span>'.$shipment->uae_firs_number.'</span></li>';
            $html.='</ul>';
            $html.='<div class="lastBTN">';
                               if($shipment->exporter->approved_farm){
                                    $html.='<span class="btn btn-success">Passed</span>';
                                }else if(!$shipment->shipment_test){
                                   $html.='<a href="'.route('lab.shipment.get_step_two',['id'=>$shipment->record_id]).'" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 2">Step 2</a>';
                                }else if(!$shipment->shipment_test_result){
                                    $html.='<a href="'.route('lab.shipment.get_step_three',['id'=>$shipment->record_id]).'" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 3">Step 3</a>';
                               }else if($shipment->shipment_test && $shipment->shipment_test_result){
                                   $html.=' <span class="btn btn-success">'.($shipment->shipment_test_result->result == 1) ? "Pass": "Fail".'</span>';
                              }
                                
           $html.=' </div></div></div>';
         }
        }else{
          if($text!='')
          $html="<div>No Data Found</div>";
        }

        echo $html; 
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::guard('admins')->user();
         $user_location = $user->office_location;
         $importers = \App\Importer::all();
         $exporters = \App\Exporter::where('country','=',$user_location->country_id)->get();
         $locations = \App\Location::where('country_id','=',$user_location->country_id)->get();
         $ports = \App\Ports::all();
        return view('customer.shipment.add',compact('importers','exporters','locations','ports'));
    }


    public function get_step_two($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first();
        $user = Auth::guard('admins')->user();
         $user_location = $user->office_location;
         $locations = \App\SupervisionLocations::where('country_id','=',$user_location->country_id)->get();
         $labs = \App\Labs::where('country','=',$user_location->country_id)->get();
         $inspection_checklist = \App\InspectionChecklist::all();
        return view('customer.shipment.step_two',compact('shipment','locations','labs','inspection_checklist'));
    }

    public function get_step_three($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first();        
         $user = Auth::guard('admins')->user();
         $user_location = $user->office_location;
         $labs = \App\Labs::where('country','=',$user_location->country_id)->get();
        return view('customer.shipment.step_three',compact('shipment','labs'));
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
            
            
            return redirect()->to('/customer/pending_shipments')->with('success','Step two registered successfully!');
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
            return redirect()->to('/customer/shipments')->with('success','Test reports added successfully!');
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
        return redirect()->to('/customer/pending_shipments')->with('success','Shipment created successfully!');
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
       return view('labuser.shipment.show_shipment',compact('shipment'));
    }

    public function shipment_detail($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first(); 
        return view('labuser.shipment.shipment_detail',compact('shipment'));
    }

    public function exporter_detail($id){
        $exporter  = Exporter::with('countryName')->where('id','=',$id)->first(); 
        return view('labuser.shipment.exporter_detail',compact('exporter'));
    }
    public function importer_detail($id){
        $importer  = Importer::with('countryName')->where('id','=',$id)->first(); 
        return view('labuser.shipment.importer_detail',compact('importer'));
    }

    

}
