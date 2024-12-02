@extends('pegawai.layouts.app')

@section('content')
<div class="container">
    <h2>Detail Transaksi #{{ $transaksi->id }}</h2>

    <table class="table table-bordered">
        <tr>
            <th>Nama Barang</th>
            <td>{{ $transaksi->nama_barang }}</td>
        </tr>
        <tr>
            <th>Jenis Transaksi</th>
            <td>{{ ucfirst($transaksi->jenis_transaksi) }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $transaksi->jumlah }}</td>
        </tr>
        <tr>
            <th>Harga Satuan</th>
            <td>Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</td>
        </tr>
    </table>

    <button onclick="window.print()" class="btn btn-secondary">Print</button>
</div>
@endsection
