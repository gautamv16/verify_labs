@extends('layouts.app')

@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"></span> Verify Shipment</h4>
            </div>
            <div class="pull-right">
                <form method="post" action="{{route('searchreport')}}">
                            @csrf
                            
                           <input type="text" placeholder="Enter FINS No" name="fins_number"  class="form-control" />
                        </form>
            </div>
        </div>
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
                                <a href="{{route('shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a>
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
                                <a href="{{route('shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a>
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
                                <a href="{{route('shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a>
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
</div>
@stop