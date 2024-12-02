<?php
namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class KelolaBarangPegawaiController extends Controller
{
    // Display the list of all barang
    public function index()
    {
        $barangs = Barang::all(); // Assume Barang is associated with a user
        return view('pegawai.barang.index', compact('barangs'));
    }

    // Show the form to create a new barang
    public function create()
    {
        return view('pegawai.barang.create');
    }

    // Store a new barang in the database
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Create the barang
        Barang::create($validated);

        // Redirect with success message
        return redirect()->route('pegawai.barang.index')->with('success', 'Barang created successfully.');
    }

    // Show the form to edit a barang
    public function edit(Barang $barang)
    {
        return view('pegawai.barang.edit', compact('barang'));
    }

    // Update the barang details
    public function update(Request $request, Barang $barang)
    {
        // Validation
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Update the barang
        $barang->update($validated);

        // Redirect with success message
        return redirect()->route('pegawai.barang.index')->with('success', 'Barang updated successfully.');
    }

    // Delete a barang
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('pegawai.barang.index')->with('success', 'Barang deleted successfully.');
    }
}
