
@extends('customer.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-user"></i></span> Payment</h4>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    @include('common.messages')
    <div class="card mb-4 border-0">
        <div class="card-body">
            <form method="post"  action="{{route('customer.shipment.payments')}}"> 
            @csrf
                <div class="col-md-12">
                    <div>
                        <p>
                            The Total Fee for your inspections is 500 AED. Kindly put the details of credit card below and pay the fee.
                        </p>
                    </div>
                    <div class="form-row">
                        <input type="hidden" name="fees" value="500" />
                        <input type="hidden" name="shipment_id" value="{{$data->id}}" />
                        <input type="hidden" name="record_id" value="{{$data->record_id}}" />
                        <input type="hidden" name="type" value="{{$type}}" />
                        <div class="form-group col-md-6 mt-5">
                         <label>Card Number<span class="required-star">*</span></label>                        
                         <input  class="form-control" name="card_number"  type="text" placeholder="">
                         <p class="invalid-field text-danger"><?php echo $errors->first('card_number'); ?></p>
                        </div>

                        <div class="form-group col-md-6 mt-5">
                            <label>Expire Month<span class="required-star">*</span></label>                        
                            <input  class="form-control" name="expire_month"  type="text" placeholder="">
                            <p class="invalid-field text-danger"><?php echo $errors->first('expire_month'); ?></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mt-5">
                         <label>Expire Year<span class="required-star">*</span></label>                        
                         <input   class="form-control" name="expire_year"  type="text" placeholder="">
                         <p class="invalid-field text-danger"><?php echo $errors->first('expire_year'); ?></p>
                        </div>

                        <div class="form-group col-md-6 mt-5">
                            <label>CVV<span class="required-star">*</span></label>                        
                            <input  class="form-control" name="cvv_number"  type="text" placeholder="">
                            <p class="invalid-field text-danger"><?php echo $errors->first('cvv_number'); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary">Pay Fee </button>
                        <!-- <a class="btn btn-sm btn-danger" href="{{route('customer.pending_shipments')}}">Cancel</a> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop