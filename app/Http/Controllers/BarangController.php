<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        // Sorting functionality
        if ($request->has('sort_by') && $request->has('order')) {
            $query->orderBy($request->get('sort_by'), $request->get('order'));
        } else {
            $query->orderBy('nama_barang', 'asc'); // Default sorting
        }

        $barangs = $query->paginate(10);

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'table' => view('barang.index', compact('barangs'))->render(),
            ]);
        }

        return view('barang.index', compact('barangs'));
    }
}
