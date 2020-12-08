
@extends('admin.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="shipment-hdr">Lab Shipment</div>
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
                        <!-- <div class="table-responsive">
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
                        </div> -->
                    </div> 
                    @endif 
                    @if(!$shipment->exporter->approved_farm && ($shipment->shipment_test_result && $shipment->shipment_test_result->result != 1))
                    <div class="failed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/failed.png') }}" height="60">
                        </div>
                        <!-- <div class="table-responsive">
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
                        </div> -->
                       
                    </div> 
                    @endif
                    @if(!$shipment->exporter->approved_farm && (!$shipment->shipment_test || !$shipment->shipment_test_result))   
                    <div class="pending">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/pending.png') }}" height="60">
                        </div>
                        <!-- <div class="table-responsive">
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
                        </div> -->
                    </div>
                @endif                
                
                </div>
                <div class="col-md-12">
                <div class="row">
                    <!-- <fieldset> -->
                <div class="outerPNL">
                    <legend class="text-primary"><h5>Shipment Detail</h5></legend>
                    <div class="col-md-12">
                        <div class=" float-left col-md-6">
                            <label class="float-left col-md-6"><b>Record ID</b></label>
                            <p class="float-left col-md-6">{{$shipment->record_id}}</p>
                        </div> <!-- form-group end.// -->
                        <div class=" float-left col-md-6">
                            <label class="float-left col-md-6"><b>Shipment Date</b></label>
                            <p class="float-left col-md-6">{{$shipment->created_date}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class=" float-left col-md-6"><b>Importer</b></label>
                            <p class="float-left col-md-6"><a href="{{route('admin.importer_detail',['id'=>$shipment->importer->id])}}">{{$shipment->importer->name}}</a></p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Exporter</b></label>
                             <p class="float-left col-md-6"><a href="{{route('admin.exporter_detail',['id'=>$shipment->exporter->id])}}">{{$shipment->exporter->name}}</a></p>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>UAE FIRS No</b></label>
                            <p class="float-left col-md-6">{{$shipment->uae_firs_number}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Location Of Registration</b></label>
                             <p class="float-left col-md-6">{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    
                    @if($shipment->exporter->approved_farm)
                    <div class="col-md-12">
                        <div class=" float-left col-md-6">
                            <label class="float-left col-md-6"><b>Status</b></label>
                            <p class="float-left col-md-6">Passed</p>
                        </div> <!-- form-group end.// -->
                    </div>
                    @endif
                </div>
                <!-- </fieldset> -->
                <!-- <fieldset> -->
                @if(!$shipment->exporter->approved_farm && $shipment->shipment_test)
                <div class="outerPNL">
                    <legend class="text-primary"><h5>Supervision & Sampling</h5></legend>
                    <div class="col-md-12">
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Location Of Supervision</b></label>
                            <p class="float-left col-md-6">{{$shipment->shipment_test->supervisionLocation->name}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Racs Lab ID</b></label>
                             <p class="float-left col-md-6">{{$shipment->shipment_test->labs->name}}</p>
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
                </div>
                @endif
                <!-- </fieldset> -->

                <!-- <fieldset> -->
                    @if(!$shipment->exporter->approved_farm && $shipment->shipment_test_result)
                <div class="outerPNL">
                    <legend class="text-primary"><h5>Testing Result</h5></legend>
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
                            <p class="float-left col-md-6">{{$shipment->shipment_test_result->labs->name}}</p>
                        </div> <!-- form-group end.// -->
                        <div class="float-left col-md-6">
                            <label class="float-left col-md-6"><b>Lab Test Result Report</b></label>

                             <p class="float-left col-md-6">
                                <a target="_blank" href="/admin/files/testing_result/{{$shipment->shipment_test_result->report_upload}}">{{$shipment->shipment_test_result->report_upload}}</a>
                            </p>
                        </div> <!-- form-group end.// -->
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