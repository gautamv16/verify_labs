@extends('admin.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
  <div class="d-flex justify-content-between">
        <div class="shipment-hdr">Shipments</div>
        <div class="New_Shipments">
        <a href="{{route('admin.getaddshipment')}}" class="d-flex align-items-center">
                <img src="{{ asset('admin/assets/img/truck.svg') }}"> 
                <span>New Shipments</span>
            </a>
        </div>
    </div>
</div>
<div>
      <div>
        <h5 class="mt-20 mb-10 text-center shipmentsHDR">Failed Shipments</h5>
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
              @if(count($failed_shipments) > 0)
                @foreach($failed_shipments as $shipment)
                <tr>
                <th scope="row"><a href="{{ route('admin.shipment.show',['id'=>$shipment->record_id])}}">{{$shipment->uae_firs_number}}</a></th>
                  <td><a href="{{route('admin.exporter_detail',['id'=>$shipment->exporter->id])}}">{{$shipment->exporter->name}}</a></td>
                  <td><a href="{{route('admin.importer_detail',['id'=>$shipment->importer->id])}}">{{$shipment->importer->name}}</a></td>
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
   
</div>
@stop

