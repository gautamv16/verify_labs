@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Search Report</div>

                <div class="card-body">
                    <form method="post" action="{{route('searchreport')}}">
                    @csrf
                       <input type="text" placeholder="Enter FINS No" name="fins_number"  class="form-control" />
               </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
