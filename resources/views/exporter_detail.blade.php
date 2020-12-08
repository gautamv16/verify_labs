
@extends('layouts.app')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="shipment-hdr">Exporter</div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4 border-0">
        <div class="card-body">
        	<div class="col-md-12">
                @if($exporter && isset($exporter->id))
                <div class="row">
                    <!-- <fieldset> -->
                <div class="outerPNL">
                    <legend class="text-primary"><h5>Exporter Detail</h5></legend>
                    <div class="col-md-12">
                        <div class=" float-left col-md-6">
                            <label class="float-left col-md-6"><b>Name</b></label>
                            <p class="float-left col-md-6">{{$exporter->name}}</p>
                        </div> <!-- form-group end.// -->
                        <div class=" float-left col-md-6">
                            <label class="float-left col-md-6"><b>Contact Name </b></label>
                            <p class="float-left col-md-6">{{$exporter->contact_name}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class=" float-left col-md-6"><b>email</b></label>
                            <p class="float-left col-md-6">{{$exporter->email}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>address</b></label>
                             <p class="float-left col-md-6">{{$exporter->address}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>City</b></label>
                            <p class="float-left col-md-6">{{$exporter->city}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Country</b></label>
                             <p class="float-left col-md-6">{{ucwords(strtolower($exporter->countryName->name))}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Primary Contact</b></label>
                            <p class="float-left col-md-6">{{$exporter->primary_contact}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Secondary Contact</b></label>
                             <p class="float-left col-md-6">{{$exporter->secondary_contact}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Approved Farm</b></label>
                            <p class="float-left col-md-6">{{($exporter->approved_farm =='1') ? 'Yes': 'No'}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    
                </div>
               
                </div>
                @else 
                    <div class="col-md-10">Record Does Not Exist</div>
                @endif
                
               
                </div>
               
         </div>
    </div>
</div>
@stop