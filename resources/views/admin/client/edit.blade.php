@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header w-36 h-11">
        Edit Client
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('fail'))
        <div class="alert alert-danger">
            {{ session()->get('fail') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/client/update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $record->id }}" name="id">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ $record->name }}" name="name" class="form-control" id="name" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{ $record->email }}" name="email" class="form-control" id="email" placeholder="Enter Email">
        </div>

        <div class="form-group">
            <label for="number">Mobile</label>
            <input type="number" value="{{ $record->number }}" name="number" class="form-control" id="number" placeholder="Enter Mobile Number">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" value="{{ $record->address }}" name="address" class="form-control" id="address" placeholder="address">
        </div>

        <div class="form-group">
            <label for="pic">Image</label>
            <input type="file" name="pic" class="form-control" id="pic" placeholder="Input an Image">
            <img src="{{ asset('images/' . $record->pic) }}" alt="img" width="50" height="50">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
