@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h3>Category Details</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $category ->name }}</h5>
            <p class="card-text"><strong>Remarks:</strong> {{ $category->remarks }}</p>
            <p class="card-text"><strong>Slug:</strong> {{ $category->slug }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $category->status == 1 ? 'Active' : 'Inactive' }}</p>
            <p class="card-text"><strong>Creator:</strong> {{ $category->creatorUser ? $category->creatorUser->name : 'N/A' }}</p>
            <p class="card-text"><strong>Editor:</strong> {{ $category->editorUser ? $category->editorUser->name : 'N/A' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $category->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $category->updated_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ '/category/show' }}" class="btn btn-primary">
                <i class="bi bi-file-earmark-text"></i> Back to Categories
            </a>
        </div>
    </div>
</div>
@endsection
