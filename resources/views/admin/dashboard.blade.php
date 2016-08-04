@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.includes.nav')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Statistics</div>
                    <div class="panel-body">
                        <pre>
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.
                            We have 3 users, 3 roles and 3 permissions.</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
