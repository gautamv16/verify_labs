@extends('labuser.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="shipment-hdr">Lab Shipments</div>
    </div>
</div>
<div class="container-fluid">
    <div class="searchBox">
            <input type="hidden" id="token" name="_token" value="{{csrf_token()}}" />
            <input type="text" id="searchText" onkeyup="searchShipments()" placeholder="Search Shipment" />
            <button onclick="searchShipments()" class="btn btn-success">Search</button>
    </div>
</div>
<div class="container-fluid">
    <div class="d-flex flex-row flex-wrap " id="searchResults">
        <div class="card-body col-md-3">
            <a href="{{route('lab.getaddshipment')}}">
             <div class="info mb-2">New</div>
            <div class="lineA mb-2"></div>
            <div class="lineA mb-2"></div>
            <div class="lineB mb-2"></div>
        </a>           
        </div>
        @foreach($shipments as $shipment)
        <div class="card-body col-md-3">
            <div class="innerBody">
            <div class="info mb-2"><a href="{{ route('lab.shipment.show',['id'=>$shipment->record_id])}}">{{$shipment->record_id}}</a></div>
            <ul class="cardUL">
                <li>Loction: <span>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name:''}}</span></li>
                <li>Date: <span>{{$shipment->created_date}}</span></li>
                <li>Importer: <span>{{$shipment->importer->name}}</span></li>
                <li>Exporter:<span>{{$shipment->exporter->name}}</span></li>
                <li>FINS NO: <span>{{$shipment->uae_firs_number}}</span></li>
            </ul>
            <div class="lastBTN">
                               @if($shipment->exporter->approved_farm)
                                    <span class="btn btn-success">Passed</span>
                                @elseif(!$shipment->shipment_test)
                                    <a href="{{ route('lab.shipment.get_step_two',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 2">Step 2</a>
                                @elseif(!$shipment->shipment_test_result)
                                    <a href="{{ route('lab.shipment.get_step_three',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 3">Step 3</a>
                                @elseif($shipment->shipment_test && $shipment->shipment_test_result)
                                    <span class="btn btn-success">{{($shipment->shipment_test_result->result == 1) ? "Pass": 'Fail'}}</span>
                                @endif
            </div>
            </div>
        </div>
        @endforeach
     <!--    <div class="card-body">
            <div class="info mb-2"></div>
            <div class="lineA mb-2"></div>
            <div class="lineA mb-2"></div>
            <div class="lineB mb-2"></div>
        </div>
        <div class="card-body">
            <div class="info mb-2"></div>
            <div class="lineA mb-2"></div>
            <div class="lineA mb-2"></div>
            <div class="lineB mb-2"></div>
        </div> -->
    </div>
</div>
<script>
    
    function searchShipments(){
        var text = $('#searchText').val();
        var csrf_token = $('#token').val();
        var url = '<?php echo url("lab/shipment/search"); ?>';
        $.ajax({
            url:url,
            method:'POST',
            data:{"_token":csrf_token,"text":text},
            success:function(data){
                console.log('data');
                $('#searchResults').html(data);
            }
        })
    }
</script>
@stop

