
@extends('admin.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="shipment-hdr">Lab Shipments</div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4 border-0">
        <div class="card-body">
            @if($shipment && isset($shipment->record_id))
                <div class="col-md-12">
                     @if($shipment->exporter->approved_farm || ($shipment->shipment_test_result && $shipment->shipment_test_result->result == 1))
                    <div class="passed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/passed.png') }}">
                        </div>
                        <div class="col-md-12">
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Exporter</b></label>
                                 <p>{{$shipment->exporter->name}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Country of Origin</b></label>
                                 <p>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Importer</b></label>
                                <p>{{$shipment->importer->name}}</p>
                            </div> <!-- form-group end.// -->
                            <div class="float-left col-md-12 text-center">
                                <a href="{{route('admin.shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a>
                            </div>    
                        </div>
                    </div> 
                    @endif 
                    @if(!$shipment->exporter->approved_farm && ($shipment->shipment_test_result && $shipment->shipment_test_result->result != 1))
                    <div class="failed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/failed.png') }}" height="60">
                        </div>
                        <div class="col-md-12">
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Exporter</b></label>
                                 <p>{{$shipment->exporter->name}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Country of Origin</b></label>
                                 <p>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Importer</b></label>
                                <p>{{$shipment->importer->name}}</p>
                            </div> <!-- form-group end.// -->
                            <div class="float-left col-md-12 text-center">
                                <a href="{{route('admin.shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a>
                            </div>    
                        </div>
                    </div> 
                    @endif
                    @if(!$shipment->exporter->approved_farm && (!$shipment->shipment_test || !$shipment->shipment_test_result))   
                    <div class="pending">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/pending.png') }}" height="60">
                        </div>
                        <div class="col-md-12">
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Exporter</b></label>
                                 <p>{{$shipment->exporter->name}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Country of Origin</b></label>
                                 <p>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Importer</b></label>
                                <p>{{$shipment->importer->name}}</p>
                            </div> <!-- form-group end.// -->
                            <div class="float-left col-md-12 text-center">
                                <a href="{{route('admin.shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a>
                            </div>    
                        </div>
                    </div>
                @endif                
              
                </div>
                @else 
                    <div class="col-md-10">Record Does Not Exist</div>
                @endif 
                </div>
        </div>
    </div>
@stop