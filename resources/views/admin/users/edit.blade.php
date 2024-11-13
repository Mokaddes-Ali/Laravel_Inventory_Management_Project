@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10 col-sm-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Edit User</h2>
                @can('product-create')
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('users.index') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                @endcan
            </div>

            <!-- Error Messages -->
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="card shadow-sm px-5 py-2">
                    <div class="mb-1">
                        <label for="name" class="form-label"><strong>Name:</strong></label>
                        <input type="text" name="name" id="name" placeholder="Enter user's name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="mb-1">
                        <label for="email" class="form-label"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" placeholder="Enter email address" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="mb-1">
                        <label for="password" class="form-label"><strong>Password:</strong></label>
                        <input type="password" name="password" id="password" placeholder="Leave blank if you don't want to change" class="form-control">
                    </div>

                    <div class="mb-1">
                        <label for="roles" class="form-label"><strong>Role:</strong></label>
                        <select name="roles[]" id="roles" class="form-control" multiple="multiple">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}"
                                    @if(in_array($role, old('roles', $userRoles))) selected @endif>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
