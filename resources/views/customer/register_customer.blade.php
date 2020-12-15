@extends('admin.layouts.admin')
@section('maincontent')
<div class="mt-auto mb-3">
    <div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="shipment-hdr">Register Customer</div>
        </div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" action="{{route('customer.createcustomer')}}"> 
            @csrf
                <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email<span class="required-star">*</span></label>
                        <input name="email" value="{{ old('email')}}" type="email" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('email'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Confrim Email<span class="required-star">*</span></label>
                        <input name="confirm_email" value="{{ old('confirm_email')}}" type="text" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('confirm_email'); ?></p>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>password<span class="required-star">*</span></label>
                        <input value="{{ old('email')}}" name="password" type="password" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('password'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Country<span class="required-star">*</span></label>
                        <select name="country" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Country::all() as $country)
                                <option value="{{$country->id}}">{{ucwords(strtolower($country->name))}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('country'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   
                    <div class="form-group">
                        <label>Importer Or Exporter<span class="required-star">*</span></label>
                        <input type="radio" name="importer_or_exporter" value="importer" checked> Importer
                        <input type="radio" name="importer_or_exporter" value="exporter"> Exporter
                        <p class="invalid-field text-danger"><?php echo $errors->first('importer_or_exporter'); ?></p>
                    </div> <!-- form-group end.// -->
                   
                </div>
                <div id="importer_div">
                     <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label>Name<span class="required-star">*</span></label>
                                <input value="{{ old('name')}}" name="name" type="" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('name'); ?></p>
                            </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                                <label>Address<span class="required-star">*</span></label>
                            <input value="{{ old('address')}}" name="address" type="" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('address'); ?></p>
                            </div> <!-- form-group end.// -->
                        </div>   
                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label>City<span class="required-star">*</span></label>
                                <input value="{{ old('city')}}" name="city" type="" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('city'); ?></p>
                            </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                                <label>Telephone<span class="required-star">*</span></label>
                            <input value="{{ old('telephone')}}" name="telephone" type="" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('telephone'); ?></p>
                            </div> <!-- form-group end.// -->
                        </div>     
                        <div class="form-row">                            
                            <div class="form-group col-md-6">
                                <label>Fax<span class="required-star">*</span></label>
                                <input value="{{ old('fax')}}" name="fax" type="" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('fax'); ?></p>
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>Contact Person<span class="required-star">*</span></label>
                                <input value="{{ old('contact_person')}}" name="contact_person" type="" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('contact_person'); ?></p>
                            </div> 
                        </div>   
                
                    <div class="form-row"  id="commercial_registration_no">
                    
                       
                    <div class="form-group col-md-6">
                            <label>Commercial Registration No<span class="required-star">*</span></label>
                            <input value="{{ old('commercial_registration_no')}}" name="commercial_registration_no" type="" class="form-control" placeholder="">
                            <p class="invalid-field text-danger"><?php echo $errors->first('commercial_registration_no'); ?></p>
                        </div> <!-- form-group end.// -->
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-sm text-white bg-theme-1">Register Customer</button>
                    <a class="btn btn-sm btn-danger" href="{{route('admin.login')}}">Cancel</a>
                </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script>
    $('input[name="importer_or_exporter"]').click(function(e){
        if(e.target.value == 'importer'){
            $('#commercial_registration_no').show();
        }else if(e.target.value == 'exporter'){ 
            $('#commercial_registration_no').hide();
        }
    })
</script>
@stop
