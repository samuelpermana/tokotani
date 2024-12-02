@extends('pegawai.layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Barang</h1>

    <form action="{{ route('owner.barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="harga_beli">Harga Beli</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $barang->harga_beli) }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="harga_jual">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Barang</button>
    </form>
</div>
@endsection
