<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Total transaction count (both masuk and keluar)
        $totalTransaksiCount = Transaksi::count();
    
        // Total "keluar" (sale) transactions
        $keluarTransaksiCount = Transaksi::where('jenis_transaksi', 'jual')->count();
        $keluarTransaksiTotal = Transaksi::where('jenis_transaksi', 'jual')->sum('harga_total');
    
        // Total "masuk" (purchase) transactions
        $masukTransaksiCount = Transaksi::where('jenis_transaksi', 'beli')->count();
        $masukTransaksiTotal = Transaksi::where('jenis_transaksi', 'beli')->sum('harga_total');
        
        // Calculate the total margin (keluar - masuk)
        $totalMargin = $keluarTransaksiTotal - $masukTransaksiTotal;
        
        return view('owner.dashboard', compact(
            'totalTransaksiCount',
            'totalMargin',
            'keluarTransaksiCount',
            'keluarTransaksiTotal',
            'masukTransaksiCount',
            'masukTransaksiTotal'
        ));
    }
}
