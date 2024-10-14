@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header w-36 h-11">
        Edit Brand
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

    <form method="POST" action="{{ url('/brands/update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $record->id }}" name="id">

        <div class="form-group">
            <label for="name">BrandName</label>
            <input type="text" value="{{ $record->brandName }}" name="brandName" class="form-control" id="name" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="brandImg">BrandImage</label>
            <input type="file" name="brandImg" class="form-control" id="brandImg" placeholder="Input an Image">
            <img src="{{ asset('BrandImage/' . $record->brandImg) }}" alt="img" width="50" height="50">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
