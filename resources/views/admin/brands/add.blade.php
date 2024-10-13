@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Add New Brand</h1>

        <!-- Show Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="brandName">Brand Name:</label>
                <input type="text" name="brandName" id="brandName" class="form-control" value="{{ old('brandName') }}" required>
            </div>

            <div class="form-group">
                <label for="brandImg">Brand Image URL (Optional):</label>
                <input type="text" name="brandImg" id="brandImg" class="form-control" value="{{ old('brandImg') }}">
            </div>

           

            <button type="submit" class="btn btn-primary">Add Brand</button>
        </form>
    </div>
@endsection
