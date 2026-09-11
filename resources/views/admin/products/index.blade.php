@extends('layout.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="d-flex align-items-center justify-content-end w-100">
            <a href="{{ route('admin.products.create') }}">
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-plus-lg text-light"></i><span class="text-white">Create</span>
            </a>
            </button>
        </div>
    </div>

    
@endsection
