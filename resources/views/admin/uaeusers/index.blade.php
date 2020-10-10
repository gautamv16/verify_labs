@extends('admin.layouts.layoutinner')
@section('content')
<div class="py-3 bg-light mt-auto mb-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                <h4 class="mt-1"><span class="sb-nav-link-icon"><i class="fas fa-users"></i></span> Users</h4>
            </div>
            <div class="pull-right">
                <a href="{{route('admin.getadd')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;Add User</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width: 50px;">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$roles[$user->role_id]}}</td>
                            <td> {{ucwords($status[$user->status])}}</td>
                            <td>
                             <a href="{{ route('admin.users.edit',['id'=>$user->id])}}" class="btn btn-sm btn-info text-white" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Edit user"><i class="fa fa-pen"></i></a>
                            <button onclick="ondelete({{$user->id}})" type="button" class="btn btn-sm btn-danger" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Delete user"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>
                        @endforeach </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('viewscripts')
<script>
    

    function ondelete(userId) {
        var url = "{{ url('/admin/users/{}/delete') }}".replace("{}", userId);
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