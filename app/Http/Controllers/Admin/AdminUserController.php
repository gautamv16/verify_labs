<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = AdminUser::where('status','=',1)->get();
          return view('admin.adminusers.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminusers.add');
    }


    protected function validator(array $data)
    {
        $message = [];
        return Validator::make($data, [
            'first_name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'last_name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'email' => 'required|unique:admin_users|email',
            'password' => 'required',
            'role_id' => 'required',
            'primary_contact' => 'required',
            'secondary_contact' => 'required',
            'status' => 'required',  
            'office_location_id'=>'required'          
           ],$message);
    }

    protected function updatevalidator(array $data,$id)
    {
        $message = [];
         return Validator::make($data, [
            'first_name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'last_name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'email' => 'required|email|unique:admin_users,email,'.$id,
            // 'password' => 'required',
            'role_id' => 'required',
            'primary_contact' => 'required',
            'secondary_contact' => 'required',
            'status' => 'required',  
            'office_location_id'=>'required'          
           ],$message);
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
            $payload['password'] = Hash::make($payload['password']);
            $admin = AdminUser::create($payload);
            return redirect()->to('/admin/adminusers')->with('success','User created successfully!');
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
    public function show(AdminUser $adminUser)
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
        $user = AdminUser::where('id','=',$id)->first();
        
        return view('admin.adminusers.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         try{
            $payload  = $request->all();
            $validator = $this->updatevalidator($payload,$id);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $admin = AdminUser::find($id);
            $admin->first_name          = $payload['first_name'];
            $admin->last_name           = $payload['last_name'];
            $admin->email               = $payload['email'];
            $admin->office_location_id  = $payload['office_location_id'];
            $admin->primary_contact     = $payload['primary_contact'];
            $admin->secondary_contact   = $payload['secondary_contact'];
            $admin->role_id             = $payload['role_id'];
            $admin->status              = $payload['status'];    
            $admin->save();
            return redirect()->to('/admin/adminusers')->with('success','User Updated successfully!');
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
    public function destroy($id)
    {
        try{
             $admin = AdminUser::find($id);
             $admin->delete(); 
            return redirect()->to('/admin/adminusers')->with('success','User Deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
