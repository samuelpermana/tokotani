<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_transaksi', 'nama_barang', 'jumlah', 'harga_satuan', 'harga_total', 'jenis_transaksi'];

}
