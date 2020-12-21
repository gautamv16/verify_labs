
@extends('customer.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div>
        <div class="d-flex align-items-center justify-content-between small">
            <div class="shipment-hdr">Request For Inspection</div>
        </div>
    </div>
</div>
<div>
    @include('common.messages')
    <div class="box mb-4 border-0">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{route('customer.saveshipment')}}"> 
            @csrf
                <div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Application Type<span class="required-star">*</span></label>
                         <div>
                            <input type="radio" name="application_type" value="new" /> New
                            <input type="radio" name="application_type" value="revision" /> Revision
                         </div>
                        <p class="invalid-field text-danger"><?php echo $errors->first('application_type'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
              
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>UAE FIRS No<span class="required-star">*</span></label>
                        <input value="{{ old('uae_firs_number')}}" name="uae_firs_number" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('uae_firs_number'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>ZAD No<span class="required-star">*</span></label>
                        <input value="{{ old('zad_number')}}" name="zad_number" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('zad_number'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                    @if($is_importer_or_exporter == 'exporter')
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
                    <input type="hidden" name = "exporter_id" value="{{$customer_exporter[0]->id}}" />
                    @endif
                    @if($is_importer_or_exporter == 'importer')
                    <div class="form-group col-md-6">
                        <label>Exporter<span class="required-star">*</span></label>
                        <select name="exporter_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($exporters as $exporter)
                                <option value="{{$exporter->id}}">{{$exporter->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('exporter_id'); ?></p>  
                        <input type="hidden" name = "importer_id" value="{{$customer_importer[0]->id}}" />                 
                    </div>
                    @endif
                    <div class="form-group col-md-6">
                        <label>Country Of Export<span class="required-star">*</span></label>
                        <select name="export_country" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach(\App\Country::all() as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('export_country'); ?></p>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Port Of Entry<span class="required-star">*</span></label>
                        <select name="port_id" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($ports as $port)
                                <option value="{{$port->id}}">{{$port->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('port_id'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Discharge Port<span class="required-star">*</span></label>
                        <select name="discharge_port" class="form-control">
                            <option value=""> -- Select -- </option>
                            @foreach($ports as $port)
                                <option value="{{$port->id}}">{{$port->name}}</option>
                            @endforeach
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('discharge_port'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php $current_date = date('Y-m-d'); ?>
                        <label>Date Of Arrival<span class="required-star">*</span></label>
                         <input value="{{ old('arrival_date')!='' ? old('arrival_date') : $current_date}}" name="arrival_date" type="" class="form-control" placeholder="">
                       
                        <p class="invalid-field text-danger"><?php echo $errors->first('arrival_date'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Shipment Method<span class="required-star">*</span></label>
                        <select name="shipment_method" class="form-control">
                            <option value="air">Air</option>
                            <option value="road"> Road</option>
                            <option value="sea">Sea</option>
                            <option value="rail">Rail</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('shipment_method'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                     <div class="form-group col-md-6">
                        <label>Shipment Method<span class="required-star">*</span></label>
                        <div class="">
                            <input type="radio" name="shipment_method_type" value="total"> Total
                            <input type="radio" name="shipment_method_type" value="partial"> Partial
                        </div>
                        
                        <p class="invalid-field text-danger"><?php echo $errors->first('shipment_method_type'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Types Of Products<span class="required-star">*</span></label>
                        <div>
                            <input type="radio" name="products_type" value="frozen"> Frozen
                            <input type="radio" name="products_type" value="canned"> Canned
                            <input type="radio" name="products_type" value="dried"> Dried
                            <input type="radio" name="products_type" value="dehydrated"> Dehydrated
                        </div>
                        
                        <p class="invalid-field text-danger"><?php echo $errors->first('products_type'); ?></p>
                    </div> <!-- form-group end.// -->
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Invoice Number<span class="required-star">*</span></label>
                        <input value="{{ old('invoice_number')}}" name="invoice_number" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('invoice_number'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Amount<span class="required-star">*</span></label>
                        <input value="{{ old('amount')}}" name="amount" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('amount'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Currency<span class="required-star">*</span></label>
                        <select name="currency" class="form-control">
                            <option>Dinar</option>
                            <option>US Dollar</option>
                        </select>
                        <p class="invalid-field text-danger"><?php echo $errors->first('currency'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>FOB Value<span class="required-star">*</span></label>
                        <input value="{{ old('fob_value')}}" name="fob_value" type="" class="form-control" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('fob_value'); ?></p>
                    </div> <!-- form-group end.// -->
                </div>
                <div class="form-row">                   
                    <div class="form-group col-md-6 mt-5">
                        <label>Upload Invoices<span class="required-star">*</span></label>                        
                        <input  name="uploaded_invoices[]" multiple type="file" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('uploaded_invoices'); ?></p>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6 mt-5">
                        <label>Upload Packaging List<span class="required-star">*</span></label>                        
                        <input  name="uploaded_packaging_list[]" multiple type="file" placeholder="">
                        <p class="invalid-field text-danger"><?php echo $errors->first('uploaded_packaging_list'); ?></p>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <div class="form-group">
                    <button class="btn btn-sm bg-theme-1 text-white">Create Inspection</button>
                    <a class="btn btn-sm btn-danger" href="{{route('customer.shipments')}}">Cancel</a>
                </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@stop