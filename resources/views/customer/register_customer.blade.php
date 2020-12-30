@extends('admin.layouts.admin')
@section('maincontent')
 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container justify-content-center">
        <a href="{{ url('/') }}">
            <img src="{{ asset('admin/assets/img/logo.png') }}" width="60">
        </a>               
    </div>
</nav>
<div class="container">
    <div class="signUP">
        <div class="d-flex align-items-center flex-column small">
            <div class="shipment-hdr font-24">Let’s create your account.</div>
            <p class="letter-02 text-center">Signing up to RACS is fast - Manage all UAE inspections in one place.
             <p>Steps:</p>
              <p>Create an account</p>

                <p>Request an inspection</p>

                <p>RACS team performs inspection and lab testing</p>

                <p>Your Shipment is ready</p>
            </p>
        </div>
        <div class="pad-vert-30">
          <div class="d-flex flex-column-mb justify-content-between text-center">
              <div class="column">
                  <div class="icon mb-10">
                    <img src="{{ asset('admin/assets/img/note.svg') }}" height="40">
                  </div>
                  <div>
                    <h6>Just the basics</h6>
                    <p>Tell us about your business so we can serve you better.</p>
                  </div>
              </div>
              <div class="column pad-20">
                  <div class="icon mb-10">
                    <img src="{{ asset('admin/assets/img/shake-hands.svg') }}" height="40">
                  </div>
                  <div>
                    <h6>No credit checks</h6>
                    <p>We’ll need the last four numbers of your SSN to verify your identity.</p>
                  </div>
              </div>
              <div class="column">
                  <div class="icon mb-10">
                    <img src="{{ asset('admin/assets/img/reader.svg') }}" height="40">
                  </div>
                  <div>
                    <h6>Get your free magstripe reader</h6>
                    <p>When you’re done, we’ll drop your free Square Reader for magstripe in the mail.</p>
                  </div>
              </div>
          </div>
        </div>
        <div>
            @include('common.messages')
            <div class="mb-4 border-0">
                <div class="signUPForm">
                    <form method="post" action="{{route('customer.createcustomer')}}"> 
                    @csrf
                        <div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email <span class="required-star">*</span></label>
                                <input name="email" value="{{ old('email')}}" type="email" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('email'); ?></p>
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>Confirm Email <span class="required-star">*</span></label>
                                <input name="confirm_email" value="{{ old('confirm_email')}}" type="text" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('confirm_email'); ?></p>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>password <span class="required-star">*</span></label>
                                <input value="{{ old('email')}}" name="password" type="password" class="form-control" placeholder="">
                                <p class="invalid-field text-danger"><?php echo $errors->first('password'); ?></p>
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>Country <span class="required-star">*</span></label>
                                <select name="country" class="form-control">
                                    <option value=""> -- Select -- </option>
                                    @foreach(\App\Country::all() as $country)
                                        <option value="{{$country->id}}">{{ucwords(strtolower($country->name))}}</option>
                                    @endforeach
                                </select>
                                <p class="invalid-field text-danger"><?php echo $errors->first('country'); ?></p>
                            </div> <!-- form-group end.// -->

                        </div>
                        <div class="form-row mtop-10">
                            <div class="form-group col-md-12 d-flex">
                                <label>Select One <span class="required-star">*</span></label>
                                <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="importer_or_exporter" id="materialchecked" value="importer" checked> 
                                    <label for="materialchecked">Importer</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="importer_or_exporter" id="materialUnchecked" value="exporter"> 
                                    <label for="materialUnchecked">Exporter</label>
                                </div>
                                </div>
                                <p class="invalid-field text-danger"><?php echo $errors->first('importer_or_exporter'); ?></p>
                            </div> <!-- form-group end.// -->
                           
                        </div>
                        <div id="importer_div">
                             <div class="form-row">
                                    
                                    <div class="form-group col-md-6">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input value="{{ old('name')}}" name="name" type="" class="form-control" placeholder="">
                                        <p class="invalid-field text-danger"><?php echo $errors->first('name'); ?></p>
                                    </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                        <label>Address <span class="required-star">*</span></label>
                                    <input value="{{ old('address')}}" name="address" type="" class="form-control" placeholder="">
                                        <p class="invalid-field text-danger"><?php echo $errors->first('address'); ?></p>
                                    </div> <!-- form-group end.// -->
                                </div>   
                                <div class="form-row">
                                    
                                    <div class="form-group col-md-6">
                                        <label>City <span class="required-star">*</span></label>
                                        <input value="{{ old('city')}}" name="city" type="" class="form-control" placeholder="">
                                        <p class="invalid-field text-danger"><?php echo $errors->first('city'); ?></p>
                                    </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                        <label>Telephone <span class="required-star">*</span></label>
                                    <input value="{{ old('primary_contact')}}" name="primary_contact" type="" class="form-control" placeholder="">
                                        <p class="invalid-field text-danger"><?php echo $errors->first('primary_contact'); ?></p>
                                    </div> <!-- form-group end.// -->
                                </div>     
                                <div class="form-row">                            
                                    <div class="form-group col-md-6">
                                        <label>Fax <span class="required-star">*</span></label>
                                        <input value="{{ old('secondary_contact')}}" name="secondary_contact" type="" class="form-control" placeholder="">
                                        <p class="invalid-field text-danger"><?php echo $errors->first('secondary_contact'); ?></p>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group col-md-6">
                                        <label>Contact Person <span class="required-star">*</span></label>
                                        <input value="{{ old('contact_name')}}" name="contact_name" type="" class="form-control" placeholder="">
                                        <p class="invalid-field text-danger"><?php echo $errors->first('contact_name'); ?></p>
                                    </div> 
                                </div>   
                        
                            <div class="form-row"  id="commercial_registration_no">
                            
                               
                            <div class="form-group col-md-6">
                                    <label>Commercial Registration No <span class="required-star">*</span></label>
                                    <input value="{{ old('commercial_registration_no')}}" name="commercial_registration_no" type="" class="form-control" placeholder="">
                                    <p class="invalid-field text-danger"><?php echo $errors->first('commercial_registration_no'); ?></p>
                                </div> <!-- form-group end.// -->
                            </div>
                        </div>

                        <div class="signUPButtons">
                            <button class="btn text-white btn-register">Register Customer</button>
                            <a class="btn btn-danger btn-cancel" href="{{route('admin.login')}}">Cancel</a>
                        </div>
                        </div>
                        
                    </form>
                </div>
            </div>
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
