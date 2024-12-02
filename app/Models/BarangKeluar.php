<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = ['tanggalkeluar', 'barang_id', 'jumlah', 'harga', 'transaksi_id'];
}
