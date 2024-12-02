@extends('pegawai.layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container">
    <h1 class="my-4">Tambah Barang</h1>

    <form action="{{ route('owner.barang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" min="1" required>
        </div>

        <div class="form-group">
            <label for="harga_beli">Harga Beli</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="0" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="harga_jual">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" min="0" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Barang</button>
    </form>
</div>
@endsection
