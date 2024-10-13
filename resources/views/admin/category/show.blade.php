@extends('layouts.master')

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('categories.index') }}" class="btn btn-primary">Add New Category</a>

    <table class="min-w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Remarks</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all as $category)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->remarks }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->status ? 'Active' : 'Inactive' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-500">Edit</a>
                        <a class="btn btn-danger btn-lg" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/categories/delete', $category->id)}}">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

