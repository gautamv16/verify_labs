
@extends('admin.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="shipment-hdr">Add UAE User</div>
        </div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" action="{{route('admin.storeuser')}}"> 
            @csrf
                <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>First Name<span class="required-star">*</span></label>
                        <input name="first_name" value="{{ old('first_name')}}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('first_name'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Last Name<span class="required-star">*</span></label>
                        <input name="last_name" value="{{ old('last_name')}}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('last_name'); ?></p>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email<span class="required-star">*</span></label>
                        <input value="{{ old('email')}}" name="email" type="email" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('email'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Password<span class="required-star">*</span></label>
                        <input value="{{ old('password')}}" name="password" type="password" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('password'); ?></p>
                    </div> <!-- form-group end.// -->
                    

                </div>
                
                <div class="form-row">
                     <div class="form-group col-md-6">
                        <label>Role<span class="required-star">*</span></label>
                        <select name="role_id" id="inputState" class="form-control">
                        <option value=""> -- Select -- </option>
                            <?php foreach(\App\Roles::where('type','=','user')->where('status','=',1)->get() as $key=>$value){ ?>
                                <option value="<?php echo $value->id;?>" {{ old('role_id') == $value->id ? 'selected' : '' }}><?php echo ucwords($value->name);?></option>
                            <?php
                                } ?>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('role_id'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Contact Number<span class="required-star">*</span></label>
                        <input value="{{ old('contact_number')}}" name="contact_number" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('contact_number'); ?></p>
                    </div> <!-- form-group end.// -->
                     
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Status<span class="required-star">*</span></label>
                        <select name="status" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }} {{ old('status') == '' ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('status'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-group">
                    <button class="btn btn-sm bg-theme-1 text-white">Create User</button>
                    <a class="btn btn-sm btn-danger" href="{{route('admin.users')}}">Cancel</a>
                </div>
                </div>
                
               
                <!-- <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small> -->
            </form>
        </div>
    </div>
</div>
@stop