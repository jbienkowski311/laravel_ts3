@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        All roles.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Permissions</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td><span data-toggle="tooltip" data-placement="top" title="Description: {{ $role->description }}">{{ $role->display_name }}</span></td>
                                    <td>{{ $role->perms()->count() }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="#" role="button">Show</a>
                                        <a class="btn btn-default btn-sm" href="#" role="button">Edit</a>
                                        <a class="btn btn-danger btn-sm" href="#" role="button">Delete</a>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
