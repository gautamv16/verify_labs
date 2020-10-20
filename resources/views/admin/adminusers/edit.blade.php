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
            <form method="post" action="{{route('admin.adminusers.update',['id'=>$user->id])}}"> 
                <input type="hidden" name="id" value="{{$user->id}}" / >
            @csrf
                 <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>First Name<span class="required-star">*</span></label>
                        <input name="first_name" value="{{ old('first_name') ? old('first_name') : $user->first_name }}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('first_name'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Last Name<span class="required-star">*</span></label>
                        <input name="last_name" value="{{ old('last_name') ? old('last_name') : $user->last_name }}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('last_name'); ?></p>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email<span class="required-star">*</span></label>
                        <input value="{{  old('email') ? old('email') : $user->email }}" name="email" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('email'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Office Location<span class="required-star">*</span></label>
                         <select name="office_location_id" id="inputState" class="form-control">
                        <option value=""> -- Select -- </option>
                          <?php  foreach(\App\OfficeLocation::where('status','=',1)->get() as $key=>$value){ ?>
                                <option value="<?php echo $value->id;?>" {{ $value->id == $user->office_location_id ? 'selected' : '' }}><?php echo ucwords($value->name);?></option>
                            <?php
                                } ?>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('office_location_id'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   <div class="form-group col-md-6">
                        <label>Role<span class="required-star">*</span></label>
                        <select name="role_id" id="inputState" class="form-control">
                        <option value=""> -- Select -- </option>
                            <?php $roles = ['1'=>'Admin','2'=>'Lab Officer']; foreach($roles as $key=>$value){ ?>
                                <option value="<?php echo $key;?>" {{ $user->role_id == $key ? 'selected' : '' }}><?php echo ucwords($value);?></option>
                            <?php
                                } ?>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('role_id'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Primary Contact<span class="required-star">*</span></label>
                        <input value="{{ old('primary_contact') ? old('primary_contact') : $user->primary_contact }}" name="primary_contact" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('primary_contact'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                   <div class="form-group col-md-6">
                        <label>Secondary Contact<span class="required-star">*</span></label>
                    <input value="{{ old('secondary_contact') ? old('secondary_contact') : $user->secondary_contact}}" name="secondary_contact" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('secondary_contact'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Status<span class="required-star">*</span></label>
                        <select name="status" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="1" {{ $user->status == '1' ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('status'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
               
                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Update User</button>
                </div>
                </div>    
            </form>
        </div>
    </div>
</div>
@stop