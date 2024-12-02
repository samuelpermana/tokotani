@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Transaksi Beli</h2>

    <form action="{{ route('owner.transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="barang_id">Pilih Barang</label>
            <select name="barang_id" id="barang_id" class="form-control" required>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" min="0" required>
        </div>

        <div class="form-group">
            <label for="jenis_transaksi">Jenis Transaksi</label>
            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                <option value="beli">Beli</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Transaksi</button>
    </form>
</div>
@endsection
