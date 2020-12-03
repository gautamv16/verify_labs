<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $locations = Location::with('country')->where('status','=',1)->get();
          return view('admin.locations.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.locations.add');
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
            $location = Location::create($payload);
            return redirect()->to('/admin/locations')->with('success','Location created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

   
    public function edit(Request $request,$id)
    {

        $location = Location::where('id','=',$id)->first();
        return view('admin.locations.edit',compact('location'));
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
