
@extends('admin.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-user"></i></span> Add Location</h4>
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
            <form method="post" action="{{route('admin.supervision_locations.store')}}"> 
            @csrf
                <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name<span class="required-star">*</span></label>
                        <input name="name" value="{{ old('name')}}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('name'); ?></p>
                    </div> <!-- form-group end.// -->                    
                </div>
               <div class="form-row">
                 <div class="form-group col-md-6">
                        <label>Country<span class="required-star">*</span></label>
                        <select name="country_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Country::all() as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
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
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }} >Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('status'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Add</button>
                    <a class="btn btn-sm btn-danger" href="{{route('admin.supervision_locations')}}">Cancel</a>
                </div>
                </div>
                
               
                <!-- <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small> -->
            </form>
        </div>
    </div>
</div>
@stop