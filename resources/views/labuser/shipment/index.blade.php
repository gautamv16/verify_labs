@extends('labuser.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="shipment-hdr">Lab Shipments</div>
    </div>
</div>
<!-- <div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-users"></i></span> Shipments</h4>
            </div>
            <div class="pull-right">
                <a href="{{route('lab.getaddshipment')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;Add Shipment</a>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="container-fluid">
    <div class="card mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Importer</th>
                            <th>Exporter</th>
                            <th>UAE FIRS NO</th>
                            <th>Regiatration Location</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shipments as $shipment)
                        <tr>
                            <td>{{$shipment->record_id}}</td>
                            <td>{{$shipment->importer->name}}</td>
                            <td>{{$shipment->exporter->name}}</td>
                            <td>{{$shipment->uae_firs_number}}</td>
                            <td>{{$shipment->registrationLocation->name}}</td>
                            <td>{{$shipment->created_date}} </td>
                            <td>
                                @if($shipment->exporter->approved_farm)
                                    <p>Passed</p>
                                @elseif(!$shipment->shipment_test)
                                    <a href="{{ route('lab.shipment.get_step_two',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 2">Step 2</a>
                                @elseif(!$shipment->shipment_test_result)
                                    <a href="{{ route('lab.shipment.get_step_three',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 3">Step 3</a>
                                @elseif($shipment->shipment_test && $shipment->shipment_test_result)
                                    <span class="btn btn-sussess">{{($shipment->shipment_test_result->result == 1) ? "Pass": 'Fail'}}</span>
                                @endif

                            </td>

                        </tr>
                        @endforeach </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->
<div class="container-fluid">
    <div class="searchBox">
        <input type="text" placeholder="Search Shipment" />
        <button class="btn btn-success">Search</button>
    </div>
</div>
<div class="container-fluid">
    <div class="d-flex flex-row flex-wrap ">
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
                <li>Loction: <span>{{$shipment->registrationLocation->name}}</span></li>
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
@stop

