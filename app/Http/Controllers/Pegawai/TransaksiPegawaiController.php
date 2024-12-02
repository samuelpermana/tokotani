<?php
namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiPegawaiController extends Controller
{
    public function dashboard()
    {
        // Get all transactions
        $transaksis = Transaksi::all();
    
        // Calculate total transaction amount, subtracting for "beli"
        $totalTransaksi = $transaksis->reduce(function ($carry, $transaksi) {
            // If the transaction type is "beli" (purchase), subtract from the total
            if ($transaksi->jenis_transaksi == 'beli') {
                return $carry - $transaksi->harga_total;
            }
            
            // Otherwise, add the transaction total
            return $carry + $transaksi->harga_total;
        }, 0);
    
        return view('pegawai.transaksi.dashboard', compact('transaksis', 'totalTransaksi'));
    }
    public function masuk()
    {
        // Get all transactions where the type is "beli" (purchase)
        $transaksis = Transaksi::where('jenis_transaksi', 'beli')->get();
        
        // Calculate the total amount of "beli" transactions (add the totals for all purchases)
        $totalTransaksi = $transaksis->reduce(function ($carry, $transaksi) {
            // Add the transaction total for "beli" (purchase)
            return $carry + $transaksi->harga_total;
        }, 0);
        
        return view('pegawai.transaksi.masuk', compact('transaksis', 'totalTransaksi'));
    }
    
    public function keluar()
    {
        // Get all transactions where the type is "jual" (sale)
        $transaksis = Transaksi::where('jenis_transaksi', 'jual')->get();
        
        // Calculate the total amount of "jual" transactions (subtract the totals for all sales)
        $totalTransaksi = $transaksis->reduce(function ($carry, $transaksi) {
            // Subtract the transaction total for "jual" (sale)
            return $carry + $transaksi->harga_total;
        }, 0);
        
        return view('pegawai.transaksi.keluar', compact('transaksis', 'totalTransaksi'));
    }
    
    // Show form for "beli" (purchase) transaction
    public function createBeli()
    {
        $barangs = Barang::all();
        return view('pegawai.transaksi.create-beli', compact('barangs'));
    }

    // Show form for "jual" (sale) transaction
    public function createJual()
    {
        $barangs = Barang::all();
        return view('pegawai.transaksi.create-jual', compact('barangs'));
    }
    // Store the transaction
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'tanggal_transaksi' => 'required|date',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'jenis_transaksi' => 'required|in:jual,beli',
        ]);

        // Get the barang record to retrieve nama_barang
        $barang = Barang::find($validated['barang_id']);
        
        // Create the transaksi record
        $transaksi = Transaksi::create([
            'tanggal_transaksi' => $validated['tanggal_transaksi'],
            'nama_barang' => $barang->nama_barang, // Store nama_barang directly
            'jumlah' => $validated['jumlah'],
            'harga_satuan' => $validated['harga_satuan'],
            'harga_total' => $validated['jumlah'] * $validated['harga_satuan'],
            'jenis_transaksi' => $validated['jenis_transaksi'],
        ]);

        // If it's a "jual" (sale), update BarangKeluar and decrease the stock
        if ($validated['jenis_transaksi'] == 'jual') {
            $barang->stok -= $validated['jumlah'];
        }

        // If it's a "beli" (purchase), update BarangMasuk and increase the stock
        if ($validated['jenis_transaksi'] == 'beli') {

            $totalStok = $barang->stok + $validated['jumlah'];
            $totalHarga = ($barang->harga_beli * $barang->stok) + ($validated['harga_satuan'] * $validated['jumlah']);
            $barang->harga_beli = $totalHarga / $totalStok;
            $barang->stok += $validated['jumlah'];
        }

        // Save the updated barang record
        $barang->save();

        return redirect()->route('pegawai.transaksi.dashboard')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barangs = Barang::all();
        // Convert tanggal_transaksi to Carbon instance if it's a string
        $transaksi->tanggal_transaksi = Carbon::parse($transaksi->tanggal_transaksi);
        return view('pegawai.transaksi.edit', compact('transaksi', 'barangs'));
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('pegawai.transaksi.dashboard')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function print($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        // You can use a library like DomPDF or Laravel Snappy PDF to generate a PDF or any custom print format
        return view('pegawai.transaksi.print', compact('transaksi'));
    }
    
    
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);
    
        // Find the transaksi to update
        $transaksi = Transaksi::findOrFail($id);
    
        // Update the transaksi record itself, but preserve the original jenis_transaksi
        $transaksi->update([
            'tanggal_transaksi' => $validated['tanggal_transaksi'],
            'jumlah' => $validated['jumlah'],
            'harga_satuan' => $validated['harga_satuan'],
            'harga_total' => $validated['jumlah'] * $validated['harga_satuan'],
            // 'jenis_transaksi' is not updated; it stays as the original
        ]);
    
        // Redirect back with success message
        return redirect()->route('pegawai.transaksi.dashboard')->with('success', 'Transaksi berhasil diperbarui.');
    }
    
    

}
