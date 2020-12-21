<?php

namespace App\Http\Controllers\Customer;

use App\AdminUser;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Location;
use App\Roles;
use App\Importer;
use App\Exporter;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data,$type)
    {
        $message = [
            'primary_contact.required'=>'The telephone field is required.',
            'secondary_contact.required'=>'The fax field is required.',
            'contact_name.required' => 'The contact person field is required.'
        ];
        if($type == 'importer'){
            return Validator::make($data, [
                'name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
                'address' => 'required',
                'email' => 'required|unique:exporters|email:rfc,dns',
                'confirm_email' => 'required',
                'password'=>'required', 
                'contact_name' => 'required',
                'city' => 'required',
                'country' =>'required',
                'primary_contact'=>'required',
                'secondary_contact'=>'required',  
                'commercial_registration_no'=>'required'
               ],$message);
        }else if($type == 'exporter'){
            return Validator::make($data, [
                'name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
                'address' => 'required',
                'email' => 'required|unique:exporters|email:rfc,dns',                
                'confirm_email' => 'required',
                'password'=>'required', 
                'contact_name' => 'required',
                'city' => 'required',
                'country' =>'required',
                'primary_contact'=>'required',
                'secondary_contact'=>'required',  
               ],$message);
        }
        return Validator::make($data, [
            'email' => 'required|unique:exporters|email:rfc,dns',
            'confirm_email' => 'required',
            'country' =>'required',
            'password'=>'required', 
           ],$message);
    }

    

    public function getSignup(){
        return view('customer/register_customer');
    }

    public function create(Request $request){
        try{ 
            
            $payload  = $request->all();
            $this->validator($payload,'');
            if($payload['importer_or_exporter']!=''){
                $validator = $this->validator($payload,$payload['importer_or_exporter']);
            }
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput($request->all());
            }
            $locationData = Location::where('country_id','=',$payload['country'])->get();
            $office_location_id = 1;
            if(count($locationData) > 0){
                $office_location_id =  $locationData[0]->id;
            }
            $roleData = Roles::where('role_key','=','customer')->get();
            $role_id = 5;
            if(count($roleData) > 0){
                $role_id = $roleData[0]->id;
            }
            $adminUser = new AdminUser();
            $payload['password'] = Hash::make($payload['password']);
            $payload['first_name'] = $payload['name'];
            $payload['last_name'] = $payload['name'];
            $payload['role_id'] = $role_id;
            $payload['office_location_id'] = $office_location_id;
            $payload['status'] = 1;
            $admin = AdminUser::create($payload);
            if($admin && $admin->id){
                $payload['user_id'] = $admin->id;
                $payload['status'] = 1;
                if($payload['importer_or_exporter'] == 'importer'){
                    $importer = Importer::create($payload);
                }else if($payload['importer_or_exporter'] == 'exporter'){
                    $exporter = Exporter::create($payload);
                }
                 
            }

            $credentials = $request->only('email', 'password');
            if (Auth::guard('admins')->attempt($credentials)) {
                return redirect()->intended('/customer/dashboard');
            }
            return redirect()->back();
           
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
      
    }

    
}
