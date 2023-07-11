@extends('Admin.layout')
@section('title', 'Educator Management')

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
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2>Educator Details</h2>
                
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
                    @foreach ($educator as $eduData)
                        <tr class="align-middle">
                            <td>{{ $count++ }}</td>
                            <td>{{ $eduData->educatorName }}</td>
                            <td>{{ $eduData->educatorEmail  }}</td>
                            <td><img src="{{ $eduData->educatorProfileImage }}" width="40px" alt="..."></td>
                            <td>{{ $eduData->blockEducator == 0 ? 'Active' : 'Blocked' }}</td>
                            <td>
                                @if ($eduData->blockEducator == 0)
                                    <a href="{{ route('change-edu-status') }}?id={{ $eduData->id }}"
                                        class="btn btn-danger btn-xs" style="width: 100px;"> <i class="fas fa-lock">
                                        </i> Block</a>
                                @else
                                    <a href="{{ route('change-edu-status') }}?id={{ $eduData->id }}"
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