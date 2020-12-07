
@extends('labuser.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="shipment-hdr">Lab Shipments</div>
    </div>
</div>
<div>
    <div class="mb-4 border-0">
        <div>
             @if($shipment && isset($shipment->record_id))
                <div>
                     @if($shipment->exporter->approved_farm || ($shipment->shipment_test_result && $shipment->shipment_test_result->result == 1))
                    <div class="passed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/passed.png') }}">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">EXPORTER</th>
                                    <th scope="col">COUNTRY OF ORIGIN</th>
                                    <th scope="col">IMPORTER</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$shipment->exporter->name}}</td>
                                    <td>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</td>
                                    <td>{{$shipment->importer->name}}</td>
                                    <td><a href="{{route('lab.shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a></td>
                                </tr>
                                                               
                              </tbody>
                            </table>    
                        </div>
                    </div> 
                    @endif 
                    @if(!$shipment->exporter->approved_farm && ($shipment->shipment_test_result && $shipment->shipment_test_result->result != 1))
                    <div class="failed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/failed.png') }}" height="60">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">EXPORTER</th>
                                    <th scope="col">COUNTRY OF ORIGIN</th>
                                    <th scope="col">IMPORTER</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$shipment->exporter->name}}</td>
                                    <td>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</td>
                                    <td>{{$shipment->importer->name}}</td>
                                    <td><a href="{{route('lab.shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a></td>
                                </tr>
                                                               
                              </tbody>
                            </table>    
                        </div>
                       
                    </div> 
                    @endif
                    @if(!$shipment->exporter->approved_farm && (!$shipment->shipment_test || !$shipment->shipment_test_result))   
                    <div class="pending">
                        
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/pending.png') }}" height="60">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">EXPORTER</th>
                                    <th scope="col">COUNTRY OF ORIGIN</th>
                                    <th scope="col">IMPORTER</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$shipment->exporter->name}}</td>
                                    <td>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</td>
                                    <td>{{$shipment->importer->name}}</td>
                                    <td><a href="{{route('lab.shipment_detail',['id'=>$shipment->record_id])}}" class="viewMore">View More</a></td>
                                </tr>
                                                               
                              </tbody>
                            </table>    
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