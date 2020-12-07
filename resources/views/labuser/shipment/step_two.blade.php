
@extends('labuser.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="shipment-hdr">Loading Supervision & Sampling</div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{route('lab.shipment.step_two')}}"> 
            @csrf
                <div>
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
                        <label>Location Of Supervision<span class="required-star">*</span></label>
                        <select name="supervision_location_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('supervision_location_id'); ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php $current_date = date('Y-m-d'); ?>
                        <label>Supervision Date<span class="required-star">*</span></label>
                         <input value="{{ old('supervision_date')!='' ? old('supervision_date') : $current_date}}" name="supervision_date" type="" class="form-control" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('supervision_date'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Racs Lab ID<span class="required-star">*</span></label>
                        <select name="lab_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($labs as $lab)
                                <option value="{{$lab->id}}">{{$lab->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('lab_id'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <label>Uploading Sampling Photos<span class="required-star">*</span></label>
                         <input  name="uploaded_files" multiple type="file" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('uploaded_files'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Supervision & Sampling</button>
                    <a class="btn btn-sm btn-danger" href="{{route('lab.shipments')}}">Cancel</a>
                </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@stop