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
                if($d->shipment_user && $d->shipment_user->office_location->id == $user_location->id){
                    $shipments[] = $d;
                }
            }
          }
          return view('labuser.shipment.index',compact('shipments'));
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
