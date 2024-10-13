@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="remarks">Remarks:</label>
            <textarea name="remarks" id="remarks">{{ old('remarks', $category->remarks) }}</textarea>
            @error('remarks')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">
            @error('slug')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
