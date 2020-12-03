<?php

namespace App\Http\Controllers\Admin;

use App\Importer;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $users = Importer::with(['countryName'])->where('status','=',1)->get();        
         $status = ["1"=>"Active","0"=>'Inactive'];
          return view('admin.importers.index',compact('users','status'));
    }


    protected function validator(array $data)
    {
        $message = [];
        return Validator::make($data, [
           'name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'address' => 'required',
            'email' => 'required|unique:importers|email:rfc,dns',
            'contact_name' => 'required',
            'city' => 'required',
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
            'email' => 'required|email|unique:importers,email,'.$id,
            'contact_name' => 'required',
            'city' => 'required',
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
        return view('admin.importers.add');
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
            $admin = Importer::create($payload);
            return redirect()->to('/admin/importers')->with('success','Importer created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Importer  $importer
     * @return \Illuminate\Http\Response
     */
    public function show(Importer $importer)
    {
        //
    }

    
    public function edit(Request $request,$id)
    {

        $user = Importer::where('id','=',$id)->first();
        return view('admin.importers.edit',compact('user'));
    }

    
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $importer = Importer::find($id);
            $importer->name              = $payload['name'];
            $importer->address           = $payload['address'];
            $importer->email             = $payload['email'];
            $importer->primary_contact   = $payload['primary_contact'];
            $importer->secondary_contact = $payload['secondary_contact'];
            $importer->contact_name      = $payload['contact_name'];
            $importer->city              = $payload['city'];  
            $importer->country           = $payload['country'];  
            $importer->status            = $payload['status'];   
            $validator = $this->updatevalidator($payload,$id);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }  
            $importer->user_id = Auth::guard('admins')->user()->id;
            $importer->save();
            return redirect()->to('/admin/importers')->with('success','Importer Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $admin = Importer::find($id);
             $admin->delete(); 
            return redirect()->to('/admin/importers')->with('success','Importer Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
