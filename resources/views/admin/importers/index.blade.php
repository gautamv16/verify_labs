@extends('admin.layouts.layoutinner')
@section('content')
<div class="mt-auto mb-3">
    <div class="d-flex justify-content-between">
        <div class="shipment-hdr">Users</div>
        <div class="pull-right">
            <a href="{{route('admin.getaddimporter')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;Add Importer</a>
        </div>
    </div>
</div>
<div>
    <div class="mb-4 border-0">
        <div>
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th style="width: 100px;">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                      @if(count($users) > 0)
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->contact_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ucwords(strtolower($user->countryName->name))}}</td>
                            <td>{{ucwords($status[$user->status])}}</td>
                            <td class="action_icons">
                             <a href="{{ route('admin.importers.edit',['id'=>$user->id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Edit user"><i class="fa fa-pen"></i></a>
                            <button onclick="ondelete({{$user->id}})" type="button" class="btn btn-sm btn-danger" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Delete user"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>
                        @endforeach 
                        @else
                        <tr>
                            <td colspan="6" style="text-align:center">No Record Exists</td>
                        </tr>
                        @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('viewscripts')
<script>
    
    function ondelete(userId) {
        var url = "{{ url('/admin/importers/{}/delete') }}".replace("{}", userId);
        alertify.confirm('Confirm', 'Are you sure you want to delete user ? ',
            function() {
                var html = '<form id="delete-form" method="post"  action="' + url + '" >@csrf<input type="hidden" name="_method" value="DELETE"></form>';
                $('body').append(html);
                $('#delete-form').submit();
            },
            function() {});
    }
</script>
@stop