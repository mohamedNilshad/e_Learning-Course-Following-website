@extends('Admin.layout')
@section('title', 'New Addmin')

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
    <h2>Add New Admin</h2>
    <form action="{{ route('new-admin') }}" method="post" enctype="multipart/form-data" class="col-md-6">
        @csrf
        <div class="form-group">
            <label for="exampleInputName">Full Name</label>
            <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                placeholder="Full Name" name="full_name" value="{{ old('full_name') }}">
            <span class="text-danger" style="font-size: 12px; text-align: start;">
                @error('full_name')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email" name="email" value="{{ old('email') }}">
            <span class="text-danger" style="font-size: 12px; text-align: start;">
                @error('email')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"
                value="{{ old('password') }}">
            <span class="text-danger" style="font-size: 12px; text-align: start;">
                @error('password')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>


@endsection
