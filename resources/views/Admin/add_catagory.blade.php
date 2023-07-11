@extends('Admin.layout')
@section('title', 'Add Category')

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
    <h2>Add New Category </h2>

    <form action="{{ route('new-category') }}" method="post" class="col-md-6">
        @csrf
        <div class="form-group">
            <label for="exampleInputName">Enter Category </label>
            <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                placeholder="Category" name="category" >
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>


@endsection
