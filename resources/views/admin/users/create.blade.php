@extends('layout.app')
@section('title')
@section('content')
    <form action="{{ route('users.store') }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Enter full name..."">
            </div>

            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Enter email address...">
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
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button class= "btn btn-primary" type="Submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
