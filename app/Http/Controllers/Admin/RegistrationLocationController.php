<?php

namespace App\Http\Controllers\Admin;

use App\RegistrationLocations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $locations = RegistrationLocations::where('status','=',1)->get();
          return view('admin.register_locations.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.register_locations.add');
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
            $admin = RegistrationLocations::create($payload);
            return redirect()->to('/admin/register_locations')->with('success','Register Location created successfully!');
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
    public function show(RegistrationLocations $registrLocation)
    {
        //
    }

    
    public function edit(Request $request,$id)
    {

        $location = RegistrationLocations::where('id','=',$id)->first();
        return view('admin.register_locations.edit',compact('location'));
    }

    
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $location = RegistrationLocations::find($id);
            $location->name             = $payload['name'];
            $location->country_id        = $payload['country_id']; 
            $location->status            = $payload['status'];     
            $location->save();
            return redirect()->to('/admin/register_locations')->with('success','Location Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $admin = RegistrationLocations::find($id);
             $admin->delete(); 
            return redirect()->to('/admin/register_locations')->with('success','Location Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
