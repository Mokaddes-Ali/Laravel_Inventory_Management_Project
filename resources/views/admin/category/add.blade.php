@extends('layouts.master')

@section('content')
    <h1>Create Category</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="remarks">Remarks:</label>
            <textarea name="remarks" id="remarks">{{ old('remarks') }}</textarea>
            @error('remarks')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>

        <button type="submit">Create</button>
    </form>
@endsection
