<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['tanggalmasuk', 'barang_id', 'jumlah', 'harga', 'transaksi_id'];
}
