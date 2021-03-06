
@extends('admin.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="shipment-hdr">Shipment Registration</div>
        </div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data"  action="{{route('admin.saveshipment')}}"> 
            @csrf
                <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Importer<span class="required-star">*</span></label>
                        <select name="importer_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Importer::all() as $importer)
                                <option value="{{$importer->id}}">{{$importer->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('importer_id'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Exporter<span class="required-star">*</span></label>
                        <select name="exporter_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Exporter::all() as $exporter)
                                <option value="{{$exporter->id}}">{{$exporter->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('exporter_id'); ?></p>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>UAE FIRS No<span class="required-star">*</span></label>
                        <input value="{{ old('uae_firs_number')}}" name="uae_firs_number" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('uae_firs_number'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6">
                        <label>Location Of Registration<span class="required-star">*</span></label>
                        <select name="registration_location_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Location::all() as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('registration_location_id'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Port Of Entry<span class="required-star">*</span></label>
                        <select name="port_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Ports::all() as $port)
                                <option value="{{$port->id}}">{{$port->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('port_id'); ?></p>
                    </div> <!-- form-group end.// -->
                     <div class="form-group col-md-6 mt-5">
                        <label>Upload Invoices<span class="required-star">*</span></label>                        
                        <input  name="uploaded_invoices[]" multiple type="file" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('uploaded_invoices'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>

                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <?php $current_date = date('Y-m-d'); ?>
                        <label>Date<span class="required-star">*</span></label>
                         <input value="{{ old('created_date')!='' ? old('created_date') : $current_date}}" name="created_date" type="" class="form-control" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('created_date'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6 mt-5">
                        <label>Upload Packaging List<span class="required-star">*</span></label>                        
                        <input  name="uploaded_packaging_list[]" multiple type="file" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('uploaded_packaging_list'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm bg-theme-1 text-white">Create Shipment</button>
                    <a class="btn btn-sm btn-danger" href="{{route('admin.shipments')}}">Cancel</a>
                </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@stop