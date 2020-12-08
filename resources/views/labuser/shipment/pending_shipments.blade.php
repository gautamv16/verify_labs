@extends('labuser.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
  <div class="d-flex justify-content-between">
        <div class="shipment-hdr">Shipments</div>
        <div class="New_Shipments">
            <a href="{{route('lab.getaddshipment')}}" class="d-flex align-items-center">
                <img src="{{ asset('admin/assets/img/truck.svg') }}"> 
                <span>New Shipments</span>
            </a>
        </div>
    </div>
</div>
<div>
      <div>
        <h5 class="mt-20 mb-10 text-center shipmentsHDR">Pending Sampling & Testing</h5>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">FIRS#</th>
                  <th scope="col">Exporter</th>
                  <th scope="col">Importer</th>
                  <th scope="col">Entry Date</th>
                  <th scope="col">Days in Stage</th>
                </tr>
              </thead>
              <tbody>
              @if(count($sampling_shipments) > 0)
                @foreach($sampling_shipments as $shipment)
                <tr>
                <th scope="row"><a href="{{ route('lab.shipment.get_step_two',['id'=>$shipment->record_id])}}">{{$shipment->uae_firs_number}}</a></th>
                  <td>{{$shipment->exporter->name}}</td>
                  <td>{{$shipment->importer->name}}</td>
                  <td>{{$shipment->created_date}}</td>
                  <td>{{ $shipment->created_date}}</td>
                </tr>
                @endforeach  
                @else
                        <tr>
                            <td colspan="5" style="text-align:center">No Record Exists</td>
                        </tr>
                        @endif             
              </tbody>
            </table>    
        </div>
    </div> 
    <div>
        <h5 class="mt-20 mb-10 text-center shipmentsHDR">Pending Lab Testing</h5>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">FIRS#</th>
                  <th scope="col">Exporter</th>
                  <th scope="col">Importer</th>
                  <th scope="col">Lab</th>
                  <th scope="col">Entry Date</th>
                  <th scope="col">Supervision Date</th>
                  <th scope="col">Days in Stage</th>
                </tr>
              </thead>
              <tbody>
                 @foreach($test_shipments as $shipment)
                <tr>
                <th scope="row"><a href="{{ route('lab.shipment.get_step_three',['id'=>$shipment->record_id])}}">{{$shipment->uae_firs_number}}</a></th>
                  <td>{{$shipment->exporter->name}}</td>
                  <td>{{$shipment->importer->name}}</td>
                  <td>{{$shipment->shipment_test->labs->name}}</td>
                  <td>{{$shipment->created_date}}</td>
                  <td>{{$shipment->shipment_test->supervision_date}}</td>
                  <td>{{$shipment->shipment_test->supervision_date}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>    
        </div>
    </div>    
    
</div>
@stop

