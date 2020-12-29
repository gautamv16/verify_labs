<?php

namespace App\Http\Controllers\Customer;

use App\Shipment;
use App\Revision;
use App\ShipmentTest;
use App\ShipmentTestResult;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Exporter;
use App\Importer;
use App\Location;

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
          $shipments = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->where('user_id','=',$user->id)->get();
          return view('customer.shipment.index',compact('shipments'));
    }

    public function revisions(){
        $user = Auth::guard('admins')->user();
        $user_location = $user->office_location;
         $revisions = Revision::with('importer','exporter','revision_user')->with(['shipment'=>function($q)use($user){
             return $q->where('user_id','=',$user->id);
         }])->where('user_id','=',$user->id)->get();
         return view('customer.shipment.revisions',compact('revisions'));
    }

    public function failed_shipments(){
        $user = Auth::guard('admins')->user();
         $user_location = $user->office_location;
          $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->where('user_id','=',$user->id)->get();
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
          $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->where('user_id','=',$user->id)->get();
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
        $user_id = $user->id;
        if($text =='' || trim($text) == ''){
            $shipments_data = Shipment::where('user_id','=',$user->id)->with('importer','exporter','registrationLocation')->with(['shipment_test'=>function($q){
                return $q->with('supervisionLocation','labs');
            }])->with(['shipment_test_result'=>function($q){
                return $q->with('labs');
            }])->get();
              if(count($shipments_data) > 0){
                    foreach($shipments_data as $k=>$d){
                        if(!$d->shipment_test_result && !$d->exporter->approved_farm ){
                            $shipments[] = $d;
                        }
                    }
                  }
        }else{
          $shipments_data = Shipment::where('uae_firs_number','LIKE','%'.$text.'%')->where('user_id','=',$user_id)->with('importer','exporter','registrationLocation')->with(['shipment_test'=>function($q){
            return $q->with('supervisionLocation','labs');
        }])->with(['shipment_test_result'=>function($q){
            return $q->with('labs');
        }])->get();
          if(count($shipments_data) > 0){
                foreach($shipments_data as $k=>$d){
                    if(!$d->shipment_test_result && !$d->exporter->approved_farm ){
                        $shipments[] = $d;
                    }
                }
              }
        }
        

        if($shipments && count($shipments) > 0){
                       foreach($shipments as $k=>$shipment){
              $html.='<li class="shipment_firs_number" id="'.$shipment->uae_firs_number.'" rel="'.$shipment->zad_number.'">'.$shipment->uae_firs_number.'</li>';
         }
        }else{
          if($text!='')
          $html="<li>No Data Found</li>";
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
         $customer_importer = \App\Importer::where('user_id','=',$user->id)->get();  
         $customer_exporter = \App\Exporter::where('user_id','=',$user->id)->get();  
         $is_importer_or_exporter = '';
         if(count($customer_importer) > 0){
            $is_importer_or_exporter = 'importer';
         }else if(count($customer_exporter) > 0){
            $is_importer_or_exporter = 'exporter';
         }

         $importers = \App\Importer::all();
         $exporters = \App\Exporter::all();
         $locations = Location::where('country_id','=',$user_location->country_id)->get();
         $ports = \App\Ports::all();
        return view('customer.shipment.add',compact('importers','exporters','locations','ports','customer_importer','customer_exporter','is_importer_or_exporter'));
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
            'zad_number' => 'required',
            'export_country' => 'required',
            'port_id' => 'required',
            'discharge_port' => 'required',
            'uploaded_invoices' => 'required',
            'uploaded_packaging_list' => 'required',
            'arrival_date' => 'required',
            'shipment_method'=>'required',
            'shipment_method_type'=>'required',
            'products_type'=>'required',
            'invoice_number'=>'required',
            'amount'=>'required',
            'currency'=>'required',
            'fob_value'=>'required',
            'application_type'=>'required'
           ],[]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
           
            $record_id = "SHP-".str_pad(rand(0, pow(10, 5)-1), 5, '0', STR_PAD_LEFT);
            $payload['user_id'] = Auth::guard('admins')->user()->id;
           
            $assetPath = "admin/files/shipment";
            $uploaded_invoices='';
            if ($request->hasfile('uploaded_invoices')) {
                foreach ($request->file('uploaded_invoices') as $key=>$file) {
                    $name=$record_id."_".($key+1).".".$file->getClientOriginalExtension();
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
                    $name=$record_id."_".($key+1).".".$file->getClientOriginalExtension();
                    $file->move($assetPath,$name); 
                    if($uploaded_packaging_list == ''){
                        $uploaded_packaging_list = $name;
                    }else{
                        $uploaded_packaging_list = $uploaded_packaging_list.",".$name;
                    }
                }
                $payload['uploaded_packaging_list']=$uploaded_packaging_list;
            }
            if($payload['application_type'] == 'new'){  
                 
                $location = Location::where('country_id','=',$payload['country_id'])->get(); 
                $location_id = null;
                            
                if(count($location)>0){
                    $location_id = $location[0]->id;
                }else{
                    $locations = Location::all(); 
                    if(count($locations)){
                        $location_id = 1;
                    }   
                }       
                $payload['registration_location_id'] = $location_id;   
                $payload['record_id'] = $record_id;  
                $payload['qr_code'] = base64_encode($record_id);
                $payload['created_date'] = date('Y-m-d');
                $shipment = Shipment::create($payload);
                return redirect()->to('/customer/pending_shipments')->with('success','Shipment created successfully!');
            }else{
                $payload['entry_port'] = $payload['port_id'];  
                $revision = Revision::create($payload);
                return redirect()->to('/customer/pending_shipments')->with('success','Revision created successfully!');
            }
            
       
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
       return view('customer.shipment.show_shipment',compact('shipment'));
    }

    public function shipment_detail($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first(); 
        return view('customer.shipment.shipment_detail',compact('shipment'));
    }

    public function exporter_detail($id){
        $exporter  = Exporter::with('countryName')->where('id','=',$id)->first(); 
        return view('customer.shipment.exporter_detail',compact('exporter'));
    }
    public function importer_detail($id){
        $importer  = Importer::with('countryName')->where('id','=',$id)->first(); 
        return view('customer.shipment.importer_detail',compact('importer'));
    }

    

}
