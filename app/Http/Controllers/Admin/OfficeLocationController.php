<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeLocation;

class OfficeLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $locations = OfficeLocation::where('status','=',1)->get();
          return view('admin.office_location.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.office_location.add');
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
            $location = OfficeLocation::create($payload);
            return redirect()->to('/admin/office_locations')->with('success','Location created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

   
    public function edit(Request $request,$id)
    {

        $location = OfficeLocation::where('id','=',$id)->first();
        return view('admin.office_locations.edit',compact('location'));
    }

    
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $location = OfficeLocation::find($id);
            $location->name              = $payload['name'];
            $location->status            = $payload['status'];     
            $location->save();
            return redirect()->to('/admin/office_locations')->with('success','Location Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $location = OfficeLocation::find($id);
             $location->delete(); 
            return redirect()->to('/admin/office_locations')->with('success','Location Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
