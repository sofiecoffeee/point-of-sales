@extends('layout.app')
@section('title')
@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Enter full name..."
                    value="{{ $user->name }}">
            </div>

            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Enter email address..."
                    value="{{ $user->email }}">
            </div>

            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Password</label>
                <input class="form-control" type="password" name="password" id="inputPassword"
                    placeholder="Enter password...">
            </div>

            <div class="mb-3">
                <label class="form-label fs-5 fw-bold" for="role">Role</label>
                <select class="form-select" name="role_id" id="role">
                    @foreach ($roles as $role)
                        <option {{ $user->role->id === $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                            {{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button class= "btn btn-primary" type="Submit">Save</button>
            </div>
        </div>
    </form>
@endsection
