@extends('labuser.layouts.layoutinner')
@section('content')
  <div class="mt-auto mb-3">
    <div>
        <div class="shipment-hdr">{{Auth::guard('admins')->user()->office_location->name}} Lab</div>
    </div>
</div>
  <!--Grid row-->
  <div class="mt-4">

  	<div class="row">
  				<!--Grid column-->
    <div class="col-lg-4 col-md-12 mb-4">

      <!-- Card -->
      <div class="outeReport">

        <div class="reportBox">

          <p class="text-uppercase small mb-2"><strong>Total Shipment This Month</strong></p>
          <h5 class="font-weight-bold mb-0">
             {{count($shipments)}}
          </h5>

          <hr>

          <p class="text-uppercase small mb-2"><strong>Shipments from Audited Exporters</strong></p>
          <h5 class="font-weight-bold mb-0">
            {{$audited_shipment}}
          </h5>

        </div>

      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4 col-md-6 mb-4">

      <!-- Card -->
      <div class="outeReport">

        <div class="reportBox">

          <p class="text-uppercase small mb-2"><strong>Passed Shipments</strong></p>
          <h5 class="font-weight-bold mb-0">
           {{$passed_shipments}}
          </h5>

          <hr>

          <p class="text-uppercase small mb-2"><strong>Failed Shipments</strong></p>
          <h5 class="font-weight-bold mb-0">
            {{$failed_shipments}}
          </h5>

        </div>

      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4 col-md-6 mb-4">

      <!-- Card -->
      <div class="outeReport">

        <div class="reportBox">

          <p class="text-uppercase small mb-2"><strong>Waiting for sampling and Testing</strong></p>
          <h5 class="font-weight-bold mb-0">
            {{$shipments_waiting_sampling}}
          </h5>

          <hr>

          <p class="text-uppercase small mb-2"><strong>Waiting For Lab</strong></p>
          <h5 class="font-weight-bold mb-0">
            {{$shipment_waiting_lab}}
          </h5>

        </div>

      </div>
      <!-- Card -->

    </div>
  	</div>
    
    <!--Grid column-->

  </div>
  <!--Grid row-->

<!--Section: Block Content-->

@stop