@extends('owner.layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pegawai</h1>

        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $pegawai->username) }}" required>
            </div>

            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $pegawai->no_telepon) }}" required>
            </div>

            <!-- Password Field (Optional) -->
            <div class="form-group">
                <label for="password">Password (biarkan kosong jika tidak ingin mengganti passwordnya)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
