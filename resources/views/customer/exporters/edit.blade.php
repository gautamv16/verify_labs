@extends('customer.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="shipment-hdr">Edit Exporter</div>
        </div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" action="{{route('customer.exporters.update',['id'=>$user->id])}}"> 
            @csrf
                  <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name<span class="required-star">*</span></label>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('name'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Contact name<span class="required-star">*</span></label>
                        <input name="contact_name" value="{{ $user->contact_name }}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('contact_name'); ?></p>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email<span class="required-star">*</span></label>
                        <input value="{{ $user->email }}" name="email" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('email'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Address<span class="required-star">*</span></label>
                        <input name="address" type="text" value="{{$user->address }}" class="form-control"  />                        
                        <p class="invalid-field text-danger"><?php echo $errors->first('address'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>City<span class="required-star">*</span></label>
                        <input value="{{  $user->city }}" name="city" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('city'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Country<span class="required-star">*</span></label>
                        <select name="country" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Country::all() as $country)
                                <option value="{{$country->id}}" {{  $user->country == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('country'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">                   
                    <div class="form-group col-md-6">
                        <label>Primary Contact<span class="required-star">*</span></label>
                        <input value="{{  $user->primary_contact}}" name="primary_contact" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('primary_contact'); ?></p>
                    </div> <!-- form-group end.// -->
                   <div class="form-group col-md-6">
                        <label>Secondary Contact<span class="required-star">*</span></label>
                    <input value="{{  $user->secondary_contact}}" name="secondary_contact" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('secondary_contact'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                   <div class="form-group col-md-6">
                        <label>Approved Farm<span class="required-star">*</span></label>
                        <select name="approved_farm" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="1" {{ $user->approved_farm == '1' ? 'selected' : '' }} >Yes</option>
                            <option value="0" {{ $user->approved_farm == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('approved_farm'); ?></p>
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
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm bg-theme-1 text-white">Update User</button>
                    <a class="btn btn-sm btn-danger" href="{{route('customer.exporters')}}">Cancel</a>
                </div>
                </div>
                
               
            </form>
        </div>
    </div>
</div>
@stop