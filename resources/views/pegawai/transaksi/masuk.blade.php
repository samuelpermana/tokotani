@extends('pegawai.layouts.app')

@section('content')
<div class="container">
    <h2>Transaksi Pembelian</h2>

    <h4>Total Transaksi: Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</h4>

    <!-- Transactions Table -->
    @if($transaksis->isEmpty())
        <p>Tidak ada data transaksi</p>
    @else
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                    <tr>
                        <td>{{ $transaksi->id }}</td>
                        <td>{{ $transaksi->nama_barang }}</td> <!-- Updated to nama_barang -->
                        <td>{{ ucfirst($transaksi->jenis_transaksi) }}</td>
                        <td>{{ $transaksi->jumlah }}</td>
                        <td>Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</td>
                        <td>
                            <!-- Edit button -->
                            <a href="{{ route('owner.transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete button -->
                            <form action="{{ route('owner.transaksi.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Delete</button>
                            </form>

                            <!-- Print button (For example, generate a PDF or print the transaction details) -->
                            <a href="{{ route('owner.transaksi.print', $transaksi->id) }}" class="btn btn-info btn-sm">Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
