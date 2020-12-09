@extends('layouts.app')

@section('content')
<div class="py-3 mt-auto">
    <div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"></span> Verify Shipment</h4>
            </div>
            <div class="pull-right">
                <form method="post" action="{{route('searchreport')}}">
                    @csrf                            
                   <input type="text" placeholder="Enter FIRS No" name="fins_number"  class="form-control" />
                </form>
            </div>
        </div>
    </div>
</div>
<div class="reportStatus">
    <div class="card mb-4 border-0">
        <div class="card-body">
            @if($shipment && isset($shipment->record_id))
                <?php $firs_no = base64_encode($shipment->uae_firs_number); ?>
                <div class="col-md-12">
                     @if($shipment->exporter->approved_farm || ($shipment->shipment_test_result && $shipment->shipment_test_result->result == 1))
                    <div class="passed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/passed.png') }}">
                        </div>
                        <div class="col-md-12" id="less_detail_passed">
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Exporter</b></label>
                                 <p><a  href="{{route('exporter_detail',['id'=>$shipment->exporter->id])}}?val=<?php echo $firs_no ?>">{{$shipment->exporter->name}}</a></p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Country of Origin</b></label>
                                 <p>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Importer</b></label>
                                <p><a   href="{{route('importer_detail',['id'=>$shipment->importer->id])}}?val=<?php echo $firs_no ?>">{{$shipment->importer->name}}</a></p>
                            </div> <!-- form-group end.// -->
                            <div class="float-left col-md-12 text-center">
                                <a onClick="show_more('passed')" href="javascript:void(0);" class="viewMore">View More</a>
                            </div>    
                        </div>
                        
                    </div>
                    @endif 
                    @if(!$shipment->exporter->approved_farm && ($shipment->shipment_test_result && $shipment->shipment_test_result->result != 1))
                    <div class="failed">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/failed.png') }}" height="60">
                        </div>
                        <div class="col-md-12" id="less_detail_failed">
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Exporter</b></label>
                                 <p><a  href="{{route('exporter_detail',['id'=>$shipment->exporter->id])}}?val=<?php echo $firs_no ?>">{{$shipment->exporter->name}}</a></p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Country of Origin</b></label>
                                 <p>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Importer</b></label>
                                <p><a  href="{{route('importer_detail',['id'=>$shipment->importer->id])}}?val=<?php echo $firs_no ?>">{{$shipment->importer->name}}</a></p>
                            </div> <!-- form-group end.// -->
                            <div class="float-left col-md-12 text-center">
                                <a onClick="show_more('failed')" href="javascript:void(0);" class="viewMore">View More</a>
                            </div>    
                        </div>
                </div>
                    </div> 
                    @endif
                    @if(!$shipment->exporter->approved_farm && (!$shipment->shipment_test || !$shipment->shipment_test_result))   
                    <div class="pending">
                        <div class="col-md-12 text-center mb-20">
                            <img src="{{ asset('admin/assets/img/pending.png') }}" height="60">
                        </div>
                        <div class="col-md-12" id="less_detail_pending">
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Exporter</b></label>
                                 <p><a  href="{{route('exporter_detail',['id'=>$shipment->exporter->id])}}?val=<?php echo $firs_no ?>">{{$shipment->exporter->name}}</a></p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Country of Origin</b></label>
                                 <p>{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</p>
                            </div>
                            <div class="float-left col-md-4 text-center">
                                <label class="shipLabel"><b>Importer</b></label>
                                <p><a  href="{{route('importer_detail',['id'=>$shipment->importer->id])}}?val=<?php echo $firs_no ?>">{{$shipment->importer->name}}</a></p>
                            </div> <!-- form-group end.// -->
                            <div class="float-left col-md-12 text-center">
                                <a onClick="show_more('pending')" href="javascript:void(0);" class="viewMore">View More</a>
                            </div>    
                        </div>                      
                     </div>
                    </div>
                    
                @endif                
                <div class="col-md-12" id="all_detail" style="display:none;">
                        <div class="row">
                            <!-- <fieldset> -->
                            <div class="outerPNL">
                                <legend class="text-primary"><h5>Shipment Detail</h5></legend>
                                    <div class="col-md-12">
                                        <div class=" float-left col-md-6">
                                            <label class="float-left col-md-6 col-xs-6"><b>FIRS Number ID</b></label>
                                            <span class="float-left col-md-6 col-xs-6">{{$shipment->uae_firs_number}}</span>
                                        </div> <!-- form-group end.// --> 
                                        <div class=" float-left col-md-6">
                                            <label class="float-left col-md-6"><b>Country</b></label>
                                            <span class="float-left col-md-6">{{($shipment->registrationLocation) ? $shipment->registrationLocation->name : ''}}</span>
                                        </div> <!-- form-group end.// --> 
                                        <div class=" float-left col-md-6">
                                            <label class="float-left col-md-6"><b>Importer</b></label>
                                            <span class="float-left col-md-6"><a  href="{{route('importer_detail',['id'=>$shipment->importer->id])}}?val=<?php echo $firs_no ?>">{{$shipment->importer->name}}</a></span>
                                        </div> <!-- form-group end.// --> 
                                        <div class=" float-left col-md-6">
                                            <label class="float-left col-md-6"><b>Exporter</b></label>
                                            <span class="float-left col-md-6"><a  href="{{route('exporter_detail',['id'=>$shipment->exporter->id])}}?val=<?php echo $firs_no ?>">{{$shipment->exporter->name}}</a></span>
                                        </div> <!-- form-group end.// -->                        
                                    </div>                   
                            </div>
                            <!-- </fieldset> -->
                            <!-- <fieldset> -->
                            @if(!$shipment->exporter->approved_farm && $shipment->shipment_test)
                            <div class="outerPNL">
                                <legend class="text-primary"><h5>Supervision & Sampling</h5></legend>
                                <div class="col-md-12">
                                    <div class="float-left col-md-6">
                                        <label class="float-left col-md-6"><b>Location Of Supervision</b></label>
                                        <span class="float-left col-md-6">{{$shipment->shipment_test->supervisionLocation->name}}</span>
                                    </div> <!-- form-group end.// -->                       
                                </div>
                                <div class="col-md-12">
                                    <div class="float-left col-md-6">
                                        <label class="float-left col-md-6"><b>Supervision Date</b></label>
                                        <span class="float-left col-md-6">{{$shipment->shipment_test->supervision_date}}</span>
                                    </div> <!-- form-group end.// -->
                                    <div class="float-left col-md-6">
                                        <label class="float-left col-md-6"><b>Sampling Photos</b></label>
                                        <span class=" float-left col-md-6">
                                        <?php 
                                            $uploaded_files = explode(",",$shipment->shipment_test->uploaded_files);
                                        ?>
                                            @if(count($uploaded_files) > 0)
                                            @foreach($uploaded_files as $file)
                                            <a target="_blank" href="/admin/files/testing/{{$file}}">{{$file}}</a>
                                            @endforeach
                                            @endif    
                                         </span>
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
                                        <label class="float-left col-md-6"><b>Lab Testing Date</b></label>
                                        <span class="float-left col-md-6">{{$shipment->shipment_test_result->testing_date}}</span>
                                    </div> <!-- form-group end.// -->
                                </div>
                                <div class="col-md-12">
                                    <div class="float-left col-md-6">
                                        <label class="float-left col-md-6"><b>Lab Test Report</b></label>
                                        <span class="float-left col-md-6">
                                        <a target="_blank" href="/admin/files/testing_result/{{$shipment->shipment_test_result->report_upload}}">{{$shipment->shipment_test_result->report_upload}}</a>
                                        </span>
                                    </div> <!-- form-group end.// -->
                                </div>
                            </div>
                            @endif
                            
                            
                        </div>
                       
                    </div> 
                @else 
                    <div class="col-md-10">Record Does Not Exist</div>
                @endif
                
               
                </div>
                
        </div>
    </div>
</div>
<script>
    function show_more(arg){
        $('#all_detail').show();
        $('#less_detail_'+arg).hide();
    }
</script>
@stop