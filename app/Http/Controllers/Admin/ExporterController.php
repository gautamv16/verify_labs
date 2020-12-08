<?php

namespace App\Http\Controllers\Admin;

use App\Exporter;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExporterController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $users = Exporter::with(['countryName'])->where('status','=',1)->get();
         $status = ["1"=>"Active","0"=>'Inactive'];
         $approved_farm = ["1"=>"Yes","0"=>"No"];
          return view('admin.exporters.index',compact('users','status','approved_farm'));
    }

    protected function validator(array $data)
    {
        $message = [];
        return Validator::make($data, [
            'name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'address' => 'required',
            'email' => 'required|unique:exporters|email:rfc,dns',
            'contact_name' => 'required',
            'city' => 'required',
            'approved_farm' => 'required',
            'country' =>'required',
            'primary_contact'=>'required',
            'secondary_contact'=>'required',
            'status' => 'required',            
           ],$message);
    }

    protected function updatevalidator(array $data,$id)
    {
        $message = [];
        return Validator::make($data, [
             'name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'address' => 'required',
            'email' => 'required|email|unique:exporters,email,'.$id,
            'contact_name' => 'required',
            'city' => 'required',
            'approved_farm' => 'required',
            'country' =>'required',
            'primary_contact'=>'required',
            'secondary_contact'=>'required',
            'status' => 'required',          
           ],$message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.exporters.add');
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
            $payload  = $request->all();
            $validator = $this->validator($payload);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $payload['user_id'] = Auth::guard('admins')->user()->id;
            $admin = Exporter::create($payload);
            return redirect()->to('/admin/exporters')->with('success','Exporter created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

   
    public function show($id)
    {
        $exporter  = Exporter::with('countryName')->where('id','=',$id)->first(); 
        return view('admin.exporters.detail',compact('exporter'));
        
    }

    
    public function edit(Request $request,$id)
    {
        $user = Exporter::where('id','=',$id)->first();
        
        return view('admin.exporters.edit',compact('user'));
    }

    
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $exporter = Exporter::find($id);
            $exporter->name             = $payload['name'];
            $exporter->address          = $payload['address'];
            $exporter->email            = $payload['email'];
            $exporter->primary_contact  = $payload['primary_contact'];
            $exporter->secondary_contact= $payload['secondary_contact'];
            $exporter->contact_name     = $payload['contact_name'];
            $exporter->city             = $payload['city'];  
            $exporter->country          = $payload['country'];  
            $exporter->approved_farm    = $payload['approved_farm']; 
            $exporter->status           = $payload['status'];    
            $validator = $this->updatevalidator($payload,$id);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $exporter->user_id = Auth::guard('admins')->user()->id;
            $exporter->save();
            return redirect()->to('/admin/exporters')->with('success','Exporter Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $admin = Exporter::find($id);
             $admin->delete(); 
            return redirect()->to('/admin/exporters')->with('success','Exporter Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
