@extends('admin.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-user"></i></span> Edit User</h4>
            </div>
            <div class="pull-right">
                <!-- <a href="#" class="btn btn-info btn-sm" role="button" aria-disabled="true"><i class="fas fa-plus"></i>&nbsp;Add Pharmacy</a> -->
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    @include('common.messages')
    <div class="card mb-4 border-0">
        <div class="card-body">
            <form method="post" > 
            @csrf
                 <div class="col-md-12">
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
                        <input value="{{ old('password')}}" name="email" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('email'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Office Location<span class="required-star">*</span></label>
                        <input value="{{ old('office_location')}}" name="office_location" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('office_location'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>Password<span class="required-star">*</span></label>
                        <input value="{{ old('password')}}" name="password" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('password'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Role<span class="required-star">*</span></label>
                        <select name="role" id="inputState" class="form-control">
                        <option value=""> -- Select -- </option>
                            <?php $roles = ['subadmin','manager']; for($i=0;$i < 2 ; $i++){ ?>
                                <option value="<?php echo $roles[$i];?>" {{ old('role') == $roles[$i] ? 'selected' : '' }}><?php echo ucwords($roles[$i]);?></option>
                            <?php
                                } ?>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('role'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>Primary Contact<span class="required-star">*</span></label>
                        <input value="{{ old('primary_contact')}}" name="primary_contact" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('primary_contact'); ?></p>
                    </div> <!-- form-group end.// -->
                   <div class="form-group col-md-6">
                        <label>Secondary Contact<span class="required-star">*</span></label>
                    <input value="{{ old('secondary_contact')}}" name="secondary_contact" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('secondary_contact'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>Status<span class="required-star">*</span></label>
                        <select name="status" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }} >Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('status'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Update User</button>
                </div>
                </div>
                
               
                <!-- <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small> -->
            </form>
        </div>
    </div>
</div>
@stop