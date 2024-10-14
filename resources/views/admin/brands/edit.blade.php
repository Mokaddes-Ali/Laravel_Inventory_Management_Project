@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
        <a href="{{ url('/brands/show') }}" class=""><button type="button" class="btn btn-secondary">Back To List</button></a>
      </div>
        <div class="mx-5 mt-2 text-center display-6">
        Brand Edit
    </div>
    </div>
    <div class="mx-5 mb-3 mt-3 col-md-10">

    <form method="POST" action="{{ url('/brands/update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $record->id }}" name="id">

        <div class="form-group col-md-8">
            <label for="name" class="mb-2">BrandName</label>
            <input type="text" value="{{ $record->brandName }}" name="brandName" class="form-control" id="name" placeholder="Enter Name">
        </div>
        <div class="form-group col-md-8">
            <label for="brandImg" class="mb-2 mt-2">BrandImage</label>
            <input type="file" name="brandImg" class="form-control" id="brandImg" placeholder="Input an Image">
            <img src="{{ asset('BrandImage/' . $record->brandImg) }}" alt="img" width="50" height="50">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
    </div>
</div>
@endsection
