@extends('layout.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="d-flex align-items-center justify-content-end w-100">
            <a href="{{ route('admin.users.create') }}"><button class="btn btn-primary" type="button">
                    <i class="bi bi-plus-lg text-light"></i><span class="text-white">Create</span>
            </a>

            </button>
        </div>
        <div>
            <table class="table table-bordered table-light my-3">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    {{-- <th>Password</th> --}}
                    <th>Role</th>
                    <th>Action</th>
                </thead>

                <tbody>
                    {{-- pake foreach ini buat ambil data semua user satu persatu secara otomatis --}}
                    @foreach ($users as $index => $value)
                        <tr>
                            {{-- yang ada $value itu format darilaravel buat manggil data, index+1 itu karena
                            ID itu kan otomatis. jadi kalo mau nomor 2 yaudah ID+1 aja --}}
                            <td>{{ $index += 1 }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            {{-- <td>{{ $value->password }}</td> --}}
                            <td>{{ $value->role->name }}</td>
                            <td>
                                {{-- edit pake anchor krn cuma nampilin form baru, cukup link biasa udah bisa buka URL edit --}}
                                <a href="{{ route('admin.users.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit
                                </a>

                                {{-- delete pake post krn berdasarkan aturan web, kalo ubah data gabole pake link biasa. ga aman.
                            jadi harus pake form dan dilengkapi csrf(token keamanan laravel) --}}
                                <form action="{{ route('admin.users.destroy', $value->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger
                                        btn-sm">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
