@extends('Admin.layout')
@section('title', 'Admin Management')

@section('content')
    <br>
    @if (Session::has('success'))
        <div class="alert alert-success"
            style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 45%; top:10%; margin-top: 12px;">
            {{ Session::get('success') }}</div>
    @elseif(Session::has('fail'))
        <div class="alert alert-danger"
            style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 45%; top:10%; margin-top: 12px;">
            {{ Session::get('fail') }}</div>
    @endif

    <br>
    
    <a href="add-new-admin" class="btn btn-primary btn-s" style="width: 100px; text-align: center; float: right;"><i class="fas fa-add"></i> Add New</a>

    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2>Admin Details</h2>
                
        </div>

    </div>
    <div class="table_section padding_infor_info">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Ful Name</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($allAdmin as $admin)
                        <tr class="align-middle">
                            <td>{{ $count++ }}</td>
                            <td>{{ $admin->admin_name }}</td>
                            <td>{{ $admin->admin_email }}</td>
                            <td><img src="{{ $admin->adminProfileImage }}" width="40px" alt="..."></td>
                            <td>{{ $admin->block_admin == 0 ? 'Active' : 'Blocked' }}</td>
                            <td>
                                @if ($admin->block_admin == 0)
                                    <a href="{{ route('change-status') }}?id={{ $admin->id }}"
                                        class="btn btn-danger btn-xs" style="width: 100px;"> <i class="fas fa-lock">
                                        </i> Block</a>
                                @else
                                    <a href="{{ route('change-status') }}?id={{ $admin->id }}"
                                        class="btn btn-success btn-xs" style="width: 100px;"> <i
                                            class="fas fa-unlock-alt"></i> Unblock</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
