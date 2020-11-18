@extends('admin.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-users"></i></span> Shipments</h4>
            </div>
            <div class="pull-right">
                <a href="{{route('admin.getaddshipment')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;Add Shipment</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
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
                            <td onclick="openshipment('{{$shipment->record_id}}')">{{$shipment->record_id}}</td>
                            <td onclick="openshipment('{{$shipment->record_id}}')">{{$shipment->importer->name}}</td>
                            <td onclick="openshipment('{{$shipment->record_id}}')">{{$shipment->exporter->name}}</td>
                            <td onclick="openshipment('{{$shipment->record_id}}')">{{$shipment->uae_firs_number}}</td>
                            <td onclick="openshipment('{{$shipment->record_id}}')">{{$shipment->registrationLocation->name}}</td>
                            <td onclick="openshipment('{{$shipment->record_id}}')">{{$shipment->created_date}} </td>
                            <td>
                                @if($shipment->exporter->approved_farm)
                                    <p>Passed</p>
                                @elseif(!$shipment->shipment_test)
                                    <a href="{{ route('admin.shipment.get_step_two',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 2">Step 2</a>
                                @elseif(!$shipment->shipment_test_result)
                                    <a href="{{ route('admin.shipment.get_step_three',['id'=>$shipment->record_id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Complete Step 3">Step 3</a>
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
</div>
<script>
    function openshipment(record_id){
        window.location.href="<?php echo url('admin/shipment/detail');?>/"+record_id;
    }
</script>
@stop

