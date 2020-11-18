<?php

namespace App\Http\Controllers\Admin;

use App\Labs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $labs = Labs::where('status','=',1)->get();
          return view('admin.labs.index',compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.labs.add');
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
            $payload['lab_id'] = $this->generate_string();
            $admin = Labs::create($payload);
            return redirect()->to('/admin/labs')->with('success','Lab created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


 
    function generate_string($strength = 10) {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
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

        $lab = Labs::where('id','=',$id)->first();
        return view('admin.labs.edit',compact('lab'));
    }

    
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $labs = Labs::find($id);
            $labs->name              = $payload['name'];
            $labs->address          = $payload['address'];
            $labs->email            = $payload['email'];
            $labs->primary_contact  = $payload['primary_contact'];
            $labs->secondary_contact= $payload['secondary_contact'];
            $labs->contact_name     = $payload['contact_name'];
            $labs->city             = $payload['city'];  
            $labs->country          = $payload['country'];                
            $labs->status            = $payload['status'];
            $labs->save();
            return redirect()->to('/admin/labs')->with('success','Lab Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $admin = Labs::find($id);
             $admin->delete(); 
            return redirect()->to('/admin/labs')->with('success','Lab Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
