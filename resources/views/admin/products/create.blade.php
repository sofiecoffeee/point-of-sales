@extends('layout.app')
@section('title')
@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Product Name</label>
                <input class="form-control" type="text" name="name" placeholder="">
            </div>

             <div class="mb-3">
                <label class="form-label fs-5 fw-bold" for="category">Product Category</label>
                <select class="form-select" name="category_id" id="categories">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Price</label>
                <input class="form-control" type="number" name="price"
                    placeholder="">
            </div>

           <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Stock</label>
                <input class="form-control" type="number" name="stock"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label class="form-label fs-5 fw-bold">Product Image</label>
                <input class="form-control" type="file" name="photo" placeholder="">
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button class= "btn btn-primary" type="Submit">Submit</button>
            </div>
        </div>
    </form>
@endsection