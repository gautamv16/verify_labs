
@extends('admin.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-user"></i></span> Testing</h4>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    @include('common.messages')
    <div class="card mb-4 border-0">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{route('admin.shipment.step_three')}}"> 
            @csrf
                <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Record ID<span class="required-star">*</span></label>
                        <input value="{{ $shipment->record_id}}" readonly class="form-control" placeholder="" name="record_id" type=""/> 
                        <p class="invalid-field text-danger"><?php echo $errors->first('record_id'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>FIRS NO<span class="required-star"></span></label>
                        <input value="{{ $shipment->uae_firs_number}}" readonly class="form-control" placeholder=""  type=""/> 
                    </div> <!-- form-group end.// -->          
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Exporter<span class="required-star"></span></label>
                        <input value="{{ $shipment->exporter->name}}" readonly class="form-control" placeholder=""  type=""/> 
                    </div> <!-- form-group end.// -->
                   <div class="form-group col-md-6">
                        <label>Importer<span class="required-star"></span></label>
                        <input value="{{ $shipment->importer->name}}" readonly class="form-control" placeholder=""  type=""/> 
                    </div> <!-- form-group end.// -->                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Entry Date<span class="required-star"></span></label>
                        <input value="{{ $shipment->created_date}}" readonly class="form-control" placeholder=""  type=""/> 
                    </div> <!-- form-group end.// -->
                   <div class="form-group col-md-6">
                        <label>Supervision Location<span class="required-star"></span></label>
                        <input value="{{ $shipment->shipment_test->supervisionLocation->name}}" readonly class="form-control" placeholder=""  type=""/> 
                    </div> <!-- form-group end.// -->                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Supervision Date<span class="required-star"></span></label>
                        <input value="{{ $shipment->shipment_test->supervision_date }}" readonly class="form-control" placeholder=""  type=""/> 
                    </div> <!-- form-group end.// --> 
                    <div class="form-group col-md-6">
                        <label>Test Result<span class="required-star">*</span></label>
                        <select name="result" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="1" {{ old('result') == '1' ? 'selected' : '' }} >Pass</option>
                            <option value="0" {{ old('result') == '0' ? 'selected' : '' }}>Fail</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('result'); ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php $current_date = date('Y-m-d'); ?>
                        <label>Testing Date<span class="required-star">*</span></label>
                         <input value="{{ old('testing_date')!='' ? old('testing_date') : $current_date}}" name="testing_date" type="" class="form-control" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('testing_date'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Testing Lab ID<span class="required-star">*</span></label>
                        <select name="lab_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Labs::all() as $lab)
                                <option value="{{$lab->id}}">{{$lab->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('lab_id'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>Upload Lab Test Report<span class="required-star">*</span></label>
                         <input  name="report_upload" type="file" class="form-control" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('report_upload'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-danger" href="{{route('admin.pending_shipments')}}">Cancel</a>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop