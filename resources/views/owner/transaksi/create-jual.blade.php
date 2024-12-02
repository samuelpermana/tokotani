@extends('owner.layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Transaksi Jual</h2>

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
                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_beli }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ old('harga_satuan') }}" readonly>
        </div>

        <div class="form-group">
            <label for="jenis_transaksi">Jenis Transaksi</label>
            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                <option value="jual">Jual</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Transaksi</button>
    </form>
</div>

<script>
    // Get the barang_id select element
    const barangSelect = document.getElementById('barang_id');
    const hargaSatuanInput = document.getElementById('harga_satuan');

    // Listen for the change event on the barang select
    barangSelect.addEventListener('change', function () {
        // Get the selected option
        const selectedOption = barangSelect.options[barangSelect.selectedIndex];
        
        // Get the harga_beli from the data attribute of the selected option
        const hargaBeli = selectedOption.getAttribute('data-harga');

        // Set the harga_satuan input value to harga_beli and make it readonly
        hargaSatuanInput.value = hargaBeli;
    });

    // Set the default harga_satuan when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        const selectedOption = barangSelect.options[barangSelect.selectedIndex];
        const hargaBeli = selectedOption.getAttribute('data-harga');
        hargaSatuanInput.value = hargaBeli;
    });
</script>
@endsection
