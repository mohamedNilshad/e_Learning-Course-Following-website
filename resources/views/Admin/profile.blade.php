@extends('Admin.layout')
@section('title', 'Profile')

@section('content')

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
    <h2>Admin Profile</h2>

    <form action="{{ route('update-admin-profile') }}" method="post" enctype="multipart/form-data" class="col-md-6">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleInputName">Full Name</label>
            <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                placeholder="Full Name" name="full_name" value="{{ $data->admin_name }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email" name="email" value="{{ $data->admin_email }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Choose Profile Image</label>
            <input type="file" class="form-control-file" accept="image/png, image/jpg, image/jpeg" id="ProfilePicture"
                name="profile">

        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>


@endsection
