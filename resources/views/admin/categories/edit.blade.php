@extends('layout.app')
@section('title')
@section('content')
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="mt-5"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Edit Category</label>
                <input class="form-control" type="text" name="name" placeholder="Enter category..."
                    value="{{ $category->name }}">
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button class= "btn btn-primary" type="Submit">Save</button>
            </div>
        </div>
    </form>
@endsection
