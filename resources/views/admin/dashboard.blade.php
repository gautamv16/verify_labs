@extends('admin.layouts.layoutinner')
@section('content')

<section>

  <!--Grid row-->
  <div class="col-md-12 mt-4">

  	<div class="row">
  				<!--Grid column-->
    <div class="col-lg-4 col-md-12 mb-4">

      <!-- Card -->
      <div class="card">

        <div class="card-body">

          <p class="text-uppercase small mb-2"><strong>Total Shipment This Month</strong></p>
          <h5 class="font-weight-bold mb-0">
             {{$shipments}}
          </h5>

          <hr>

          <p class="text-uppercase text-muted small mb-2"><strong>Shipments from Audited Exporters</strong></p>
          <h5 class="font-weight-bold text-muted mb-0">
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
      <div class="card">

        <div class="card-body">

          <p class="text-uppercase small mb-2"><strong>Passed Shipments</strong></p>
          <h5 class="font-weight-bold mb-0">
           {{$passed_shipments}}
          </h5>

          <hr>

          <p class="text-uppercase text-muted small mb-2"><strong>Failed Shipments</strong></p>
          <h5 class="font-weight-bold text-muted mb-0">
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
      <div class="card">

        <div class="card-body">

          <p class="text-uppercase small mb-2"><strong>Waiting for sampling and Testing</strong></p>
          <h5 class="font-weight-bold mb-0">
            {{$shipments_waiting_sampling}}
          </h5>

          <hr>

          <p class="text-uppercase text-muted small mb-2"><strong>Waiting For Lab</strong></p>
          <h5 class="font-weight-bold text-muted mb-0">
            {{$shipment_waiting_lab}}
          </h5>

        </div>

      </div>
      <!-- Card -->

    </div>

    	<div class="col-lg-4 col-md-6 mb-4">

      <!-- Card -->
      <div class="card">

        <div class="card-body">

          <p class="text-uppercase small mb-2"><strong>Registered Importers</strong></p>
          <h5 class="font-weight-bold mb-0">
            {{$importers}}
          </h5>

          <hr>

          <p class="text-uppercase text-muted small mb-2"><strong>Registered Exporters</strong></p>
          <h5 class="font-weight-bold text-muted mb-0">
            {{$exporters}}
          </h5>

        </div>

      </div>
      <!-- Card -->

    </div>

  	</div>
    
    <!--Grid column-->

  </div>
  <!--Grid row-->

</section>
<!--Section: Block Content-->

@stop