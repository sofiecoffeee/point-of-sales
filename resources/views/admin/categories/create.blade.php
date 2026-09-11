@extends('layout.app')
@section('title')
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Add New Category</label>
                <input class="form-control" type="text" name="name" placeholder="Add new Category...">
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button class= "btn btn-primary" type="Submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
