<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id('id');
            $table->date('tanggalmasuk');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);
            $table->unsignedBigInteger('transaksi_id'); // Foreign key tanpa constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
