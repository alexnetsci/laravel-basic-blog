@extends('admin/layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Manage Users</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Registered On</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Manage Roles</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($user->id != Auth::user()->id)
                                                @if ($user->hasRole('admin'))
                                                    <a href="{{ route('admin.remove_admin', $user->id) }}" class="btn btn-warning">Remove Admin Role</a>
                                                @else
                                                    <a href="{{ route('admin.give_admin', $user->id) }}" class="btn btn-success">Give Admin Role</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td><i class="fas fa-eye"></i></td>
                                        <td><i class="fas fa-edit"></i></td>
                                        <td><i class="fas fa-trash-alt"></i></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary btn-block" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
    </div>
</div>
@endsection
