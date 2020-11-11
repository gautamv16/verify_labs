@extends('layouts.app')

@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-user"></i></span> Verify Shipment</h4>
            </div>
            <div class="pull-right">
                <!-- <a href="#" class="btn btn-info btn-sm" role="button" aria-disabled="true"><i class="fas fa-plus"></i>&nbsp;Add Pharmacy</a> -->
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4 border-0">
        <div class="card-body">
                <div class="col-md-12">

                     <form method="post" action="{{route('searchreport')}}">
                        @csrf
                            <label>Search</label>
                           <input type="text" placeholder="Enter FINS No" name="fins_number"  class="form-control" />
                   </form>
                <br/>
                @if($shipment && isset($shipment->record_id))
                <div class="row">
                    <!-- <fieldset> -->
                    <legend class="text-primary"><h5>Shipment Detail</h5></legend>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class=" float-left col-md-6"><b>Importer</b></label>
                            <p class="float-left col-md-6">{{$shipment->importer->name}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Exporter</b></label>
                             <p class="float-left col-md-6">{{$shipment->exporter->name}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>UAE FIRS No</b></label>
                            <p class="float-left col-md-6">{{$shipment->uae_firs_number}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Location Of Registration</b></label>
                             <p class="float-left col-md-6">{{$shipment->registrationLocation->name}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class=" float-left col-md-6">
                            <label class="float-left col-md-6"><b>Shipment Date</b></label>
                            <p class="float-left col-md-6">{{$shipment->created_date}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                <!-- </fieldset> -->

                <!-- <fieldset> -->
                    <legend class="text-primary">Supervision & Sampling</legend>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Location Of Supervision</b></label>
                            <p class="float-left col-md-6">{{$shipment->shipment_test->supervisionLocation->name}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Racs Lab ID</b></label>
                             <p class="float-left col-md-6">{{$shipment->shipment_test->labs->lab_id}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Supervision Date</b></label>
                            <p class="float-left col-md-6">{{$shipment->shipment_test->supervision_date}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Sampling Photos</b></label>
                             <p class=" float-left col-md-6">
                                <a target="_blank" href="/admin/files/testing/{{$shipment->shipment_test->uploaded_files}}">{{$shipment->shipment_test->uploaded_files}}</a>
                                </p>
                        </div> <!-- form-group end.// -->
                    </div>
                <!-- </fieldset> -->

                <!-- <fieldset> -->
                    <legend class="text-primary">Testing Result</legend>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Result</b></label>
                            <p class="float-left col-md-6">{{($shipment->shipment_test_result->result == 1) ? "PASS": "FAIL"}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Testing Date</b></label>
                             <p class="float-left col-md-6">{{$shipment->shipment_test_result->testing_date}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Testing Lab ID</b></label>
                            <p class="float-left col-md-6">{{$shipment->shipment_test_result->labs->lab_id}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Lab Test Result Report</b></label>

                             <p class="float-left col-md-6">
                                <a target="_blank" href="/admin/files/testing_result/{{$shipment->shipment_test_result->report_upload}}">{{$shipment->shipment_test_result->report_upload}}</a>
                            </p>
                        </div> <!-- form-group end.// -->
                    </div>
                </fieldset>
                </div>
                @else 
                    <div class="col-md-10">Record Does Not Exist</div>
                @endif
                
               
                </div>
                
               
               
        </div>
    </div>
</div>
@stop