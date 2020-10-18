<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::where('status','=',1)->get();
         $roles = ["1"=>"Verifying Officer","2"=>'Helper'];
         $status = ["1"=>"Active","0"=>'Inactive'];
          return view('admin.uaeusers.index',compact('users','roles','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.uaeusers.add');
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
            $payload['password'] = Hash::make($payload['password']);
            $user = User::create($payload);
            return redirect()->to('/admin/users')->with('success','UAE User created successfully!');
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
    public function show(User $adminUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::where('id','=',$id)->first();
        
        return view('admin.uaeusers.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id )
    {
        try{
            $payload  = $request->all();
            $exporter = User::find($id);
            $exporter->first_name             = $payload['first_name'];
            $exporter->last_name          = $payload['last_name'];
            $exporter->email            = $payload['email'];
            $exporter->contact_number  = $payload['contact_number'];
            $exporter->role_id     = $payload['role_id'];
            $exporter->status           = $payload['status'];    
            $exporter->save();
            return redirect()->to('/admin/users')->with('success','UAE User Updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $adminUser)
    {
        try{
             $admin = User::find($id);
             $admin->delete(); 
            return redirect()->to('/admin/users')->with('success','UAE User Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
