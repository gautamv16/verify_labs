@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="searchShipment flex-column">
            <div class="d-flex justify-content-center align-items-center searchuprLogo mb-20">
                <img src="{{ asset('admin/assets/img/lab-verification-logo.png') }}" height="60"> 
                <span>Search Shipment</span>
            </div>

            <div class="relative">
                <form method="post" action="{{route('searchreport')}}">
                @csrf
                    <i class="fa fa-search"></i>
                   <input type="text" placeholder="Enter FIRS No" name="fins_number"  class="form-control" />
                   <button class="btn btn-search">Search</button>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endsection
