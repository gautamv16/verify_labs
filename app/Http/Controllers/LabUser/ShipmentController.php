<?php

namespace App\Http\Controllers\LabUser;

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
        $user = Auth::guard('admins')->user();
        $user_location = $user->office_location;
          $shipments_data = Shipment::with('importer','exporter','registrationLocation','shipment_test','shipment_test_result','shipment_user')->get();
          $shipments = [];
          if(count($shipments_data) > 0){
            foreach($shipments_data as $k=>$d){
                if($d->shipment_user->office_location->id == $user_location->id){
                    $shipments[] = $d;
                }
            }
          }
          return view('labuser.shipment.index',compact('shipments'));
    }

    public function searchShipments(Request $request){
        $text = $request->input('text');
        $shipment = Shipment::where('uae_firs_number','LIKE',$text)->orWhere('record_id','LIKE',$text)->with('importer','exporter','registrationLocation')->with(['shipment_test'=>function($q){
            return $q->with('supervisionLocation','labs');
        }])->with(['shipment_test_result'=>function($q){
            return $q->with('labs');
        }])->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('labuser.shipment.add');
    }


    public function get_step_two($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first();
        return view('labuser.shipment.step_two',compact('shipment'));
    }

    public function get_step_three($record_id){
        $shipment  = Shipment::where('record_id','=',$record_id)->first();
        return view('labuser.shipment.step_three',compact('shipment'));
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
            return redirect()->to('/lab/shipments')->with('success','Step two registered successfully!');
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
            return redirect()->to('/lab/shipments')->with('success','Step three registered successfully!');
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
            $record_id = "SHP-".random_int(4, 10);
            $payload['record_id'] = $record_id; 
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            $payload['qr_code'] = base64_encode($record_id);
            $shipment = Shipment::create($payload);
        return redirect()->to('/lab/shipments')->with('success','Register Location created successfully!');
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

    

}
