<?php

namespace App\Http\Controllers\Admin;

use App\Exporter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExporterController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $users = Exporter::where('status','=',1)->get();
          return view('admin.exporters.index',compact('users'));
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
            $admin = Exporter::create($payload);
            return redirect()->to('/admin/exporters')->with('success','Exporter created successfully!');
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
    public function show(Exporter $exporter)
    {
        //
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