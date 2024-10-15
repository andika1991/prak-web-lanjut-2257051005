@extends('layouts.app')
@section('title', 'Daftar User')
@section('content')

<!-- Header Section -->
<header class="bg-primary text-white text-center py-4 mb-5">
    <h1 class="display-4">Sistem Manajemen User</h1>
    <p class="lead">Kelola semua data pengguna dengan mudah.</p>
</header>

<div class="container mt-5">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-success">Tambah User Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Foto</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data user.</td>
                </tr>
            @else
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->npm }}</td>
                        <td>
                        <img src="{{ Storage::url($user->foto) }}" alt="User Photo" width="100" class="mt-2">
                        </td>
                        <td>{{ $user->nama_kelas }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-warning">detail</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<!-- Footer Section -->
<footer class="bg-light text-center py-4 mt-5">
    <p class="mb-0">&copy; {{ date('Y') }} Andika Fikri Azhari-2257051005. All rights reserved.</p>
</footer>

@endsection
