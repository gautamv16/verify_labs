<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ports;

class PortsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $ports = Ports::with('country')->where('status','=',1)->get();
          return view('admin.ports.index',compact('ports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.ports.add');
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
            $ports = Ports::create($payload);
            return redirect()->to('/admin/locations')->with('success','Port created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

   
    public function edit(Request $request,$id)
    {

        $port = Ports::where('id','=',$id)->first();
        return view('admin.ports.edit',compact('port'));
    }

    
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $location = Location::find($id);
            $location->name              = $payload['name'];
            $location->status            = $payload['status']; 
            $location->country_id        = $payload['country_id'];    
            $location->save();
            return redirect()->to('/admin/locations')->with('success','Location Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $location = Location::find($id);
             $location->delete(); 
            return redirect()->to('/admin/locations')->with('success','Location Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
