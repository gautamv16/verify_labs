<?php

namespace App\Http\Controllers\Customer;

use App\AdminUser;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        $message = [];
        return Validator::make($data, [
            'name' => 'required|regex:/^[a-zA-Z ]*$/|string|max:100',
            'address' => 'required',
            'email' => 'required|unique:exporters|email:rfc,dns',
            'contact_name' => 'required',
            'city' => 'required',
            'country' =>'required',
            'primary_contact'=>'required',
            'secondary_contact'=>'required',  
           ],$message);
    }

    public function getSignup(){
        return view('customer/register_customer');
    }

    public function create(Request $request){
        // return view('customer/register_customer');
    }

    
}
