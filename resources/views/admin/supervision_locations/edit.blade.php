@extends('admin.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="shipment-hdr">Edit Location</div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" action="{{route('admin.supervision_locations.update',['id'=>$location->id])}}"> 
            @csrf
                   <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name<span class="required-star">*</span></label>
                        <input name="name" value="{{ $location->name }}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('name'); ?></p>
                    </div> <!-- form-group end.// -->
                   
                    
                </div>
                <div class="form-row">
                 <div class="form-group col-md-6">
                        <label>Country<span class="required-star">*</span></label>
                        <select name="country_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Country::all() as $country)
                                <option value="{{$country->id}}" {{  $location->country_id == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('country_id'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                
                
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>Status<span class="required-star">*</span></label>
                        <select name="status" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="1" {{ $location->status == '1' ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ $location->status == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('status'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm bg-theme-1 text-white">Update</button>
                    <a class="btn btn-sm btn-danger" href="{{route('admin.supervision_locations')}}">Cancel</a>
                </div>
                </div>
                
               
                <!-- <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small> -->
            </form>
        </div>
    </div>
</div>
@stop