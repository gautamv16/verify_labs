
@extends('labuser.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-user"></i></span> Shipment Registration</h4>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    @include('common.messages')
    <div class="card mb-4 border-0">
        <div class="card-body">
            <form method="post" action="{{route('lab.saveshipment')}}"> 
            @csrf
                <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Importer<span class="required-star">*</span></label>
                        <select name="importer_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($importers as $importer)
                                <option value="{{$importer->id}}">{{$importer->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('importer_id'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Exporter<span class="required-star">*</span></label>
                        <select name="exporter_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($exporters as $exporter)
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
                            @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('registration_location_id'); ?></p>
                    </div> <!-- form-group end.// -->

                </div>
                <div class="form-row">
                   
                    <div class="form-group col-md-6">
                        <?php $current_date = date('Y-m-d'); ?>
                        <label>Date<span class="required-star">*</span></label>
                         <input value="{{ old('created_date')!='' ? old('created_date') : $current_date}}" name="created_date" type="" class="form-control" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('created_date'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm btn-primary">Create Shipment</button>
                    <a class="btn btn-sm btn-danger" href="{{route('lab.shipments')}}">Cancel</a>
                </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@stop