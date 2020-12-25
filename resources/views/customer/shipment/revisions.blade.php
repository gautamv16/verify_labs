@extends('customer.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="shipment-hdr">Revisions</div>
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
        <h5 class="mt-20 mb-10 text-center shipmentsHDR">Revisions</h5>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">FIRS#</th>
                  <th scope="col">Exporter</th>
                  <th scope="col">Importer</th>
                  <th scope="col">Arrival Date</th>
                  <th scope="col">Shipment Method</th>
                </tr>
              </thead>
              <tbody>
              @if(count($revisions) > 0)
                @foreach($revisions as $revision)
                <?php
                    $url =route('customer.shipment.get_step_two',['id'=>$revision->record_id]);
                ?>
                <tr>
                  <th scope="row"><a href="{{ route('customer.shipment.show',['id'=>$revision->shipment->record_id])}}">{{$revision->uae_firs_number}}</a></th>
                  <td><a href="{{route('customer.exporter_detail',['id'=>$revision->exporter->id])}}">{{$revision->exporter->name}}</a></td>
                  <td><a href="{{route('customer.importer_detail',['id'=>$revision->importer->id])}}">{{$revision->importer->name}}</a></td>
                  <td>{{$revision->arrival_date}}</td>
                  <td class="tblbuttons">{{ucwords($revision->shipment_method)}}  </td>
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

