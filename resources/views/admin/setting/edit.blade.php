@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header w-36 h-11">
        Add Settings
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    {{-- Form starts here --}}
    <form method="POST" action="{{ url('/settings/update') }}" enctype="multipart/form-data">
        @csrf
        {{-- Hidden field for ID --}}
        <input type="hidden" name="id" value="{{ $data->id }}">

        {{-- Company Name field --}}
        <div class="form-group">
            <label for="companyName">Company Name</label>
            <input type="text" name="company_name" class="form-control" id="companyName" value="{{ $data->company_name }}" placeholder="Enter Company Name">
        </div>

        {{-- Email field --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $data->email }}" placeholder="Enter Email">
        </div>

        {{-- Mobile field --}}
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="number" name="mobile" class="form-control" id="mobile" value="{{ $data->mobile }}" placeholder="Enter Mobile Number">
        </div>

        {{-- Address field --}}
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ $data->address }}" placeholder="Enter Address">
        </div>

        {{-- Logo field --}}
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" class="form-control" id="logo" placeholder="Upload Logo">
            @if($data->logo)
                <img src="{{ asset('logo/'.$data->logo) }}" alt="Current Logo" width="50" height="50">
            @endif
        </div>

        {{-- Submit button --}}
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
    {{-- Form ends here --}}
</div>
@endsection
