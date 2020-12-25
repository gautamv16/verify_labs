@extends('customer.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="shipment-hdr">Inspections</div>
        <div class="New_Shipments">
            <a href="{{route('customer.getaddshipment')}}" class="d-flex align-items-center">
                <img src="{{ asset('admin/assets/img/truck.svg') }}"> 
                <span>Request New Inspection</span>
            </a>
        </div>
    </div>
</div>
<div>
     <div>
        <h5 class="mt-20 mb-10 text-center shipmentsHDR">Completed Inspections</h5>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">FIRS#</th>
                  <th scope="col">Exporter</th>
                  <th scope="col">Importer</th>
                  <th scope="col">Entry Date</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              @if(count($shipments) > 0)
                @foreach($shipments as $shipment)
                <tr>
                  <th scope="row"><a href="{{ route('customer.shipment.show',['id'=>$shipment->record_id])}}">{{$shipment->uae_firs_number}}</a></th>
                  <td><a href="{{route('customer.exporter_detail',['id'=>$shipment->exporter->id])}}">{{$shipment->exporter->name}}</a></td>
                  <td><a href="{{route('customer.importer_detail',['id'=>$shipment->importer->id])}}">{{$shipment->importer->name}}</a></td>
                  <td>{{$shipment->created_date}}</td>
                  <td class="tblbuttons">
                    @if($shipment->exporter->approved_farm)
                                    <span class="btn btn-success">Auto Passed</span>
                                @elseif(!$shipment->shipment_test)
                                    <a href="{{ route('customer.shipment.get_step_two',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 2">Sampling & Supervision</a>
                                @elseif(!$shipment->shipment_test_result)
                                    <a href="{{ route('customer.shipment.get_step_three',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 3">Lab Testing</a>
                                @elseif($shipment->shipment_test && $shipment->shipment_test_result)
                                    <span class="btn btn-success">{{($shipment->shipment_test_result->result == 1) ? "Passed": 'Fail'}}</span>
                                @endif
                  </td>
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
</div>


@stop

