@extends('pegawai.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Transaksi #{{ $transaksi->id }}</h2>

    <form action="{{ route('owner.transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d')) }}" required>
        </div>

        <!-- Display barang name as text, not editable -->
        <div class="form-group">
            <label for="barang_id">Barang</label>
            <input type="text" class="form-control" value="{{ $transaksi->nama_barang }}" disabled> <!-- Display barang name -->
            <input type="hidden" name="barang_id" value="{{ $transaksi->barang_id }}"> <!-- Keep the original barang ID for submission -->
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="{{ old('jumlah', $transaksi->jumlah) }}" required>
        </div>

        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ old('harga_satuan', $transaksi->harga_satuan) }}" required>
        </div>

        <!-- Disable the jenis_transaksi field to prevent changes -->
        <div class="form-group">
            <label for="jenis_transaksi">Jenis Transaksi</label>
            <input type="text" class="form-control" value="{{ ucfirst($transaksi->jenis_transaksi) }}" disabled>
            <input type="hidden" name="jenis_transaksi" value="{{ $transaksi->jenis_transaksi }}"> <!-- Keep the original value for submission -->
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Transaksi</button>
    </form>
</div>
@endsection
