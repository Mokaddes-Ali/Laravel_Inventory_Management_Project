

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Category Details</h2>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Remarks</th>
                <th>Slug</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->remarks }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->status }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
