<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Barang;
use App\Models\Owner;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        $users = [
            ['username' => 'pegawai1', 'password' => Hash::make('password'), 'role' => 'pegawai'],
            ['username' => 'owner1', 'password' => Hash::make('password'), 'role' => 'owner'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Seed Pegawai
        Pegawai::create([
            'username' => 'pegawai1',
            'no_telepon' => '081234567890',
            'user_id' => User::where('username', 'pegawai1')->first()->id,
        ]);

        // Seed Owners
        Owner::create([
            'username' => 'owner1',
            'user_id' => User::where('username', 'owner1')->first()->id,
        ]);

        // Seed Barangs
        $barangs = [
            [
                'nama_barang' => 'Pupuk Organik',
                'deskripsi' => 'Pupuk ramah lingkungan untuk tanaman.',
                'stok' => 50,
                'harga_jual' => 50000,
                'harga_beli' => 40000,
            ],
            [
                'nama_barang' => 'Benih Jagung',
                'deskripsi' => 'Benih jagung berkualitas tinggi.',
                'stok' => 100,
                'harga_jual' => 20000,
                'harga_beli' => 15000,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
