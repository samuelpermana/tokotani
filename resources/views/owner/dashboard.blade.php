@extends('owner.layouts.app')

@section('content')
    <style>

        .content {
            margin-top: 20px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            color: #333;
        }

        .card h2 {
            margin-bottom: 15px;
            color: #2C3E50;
        }

        .card p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .card .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .card .btn:hover {
            background-color: #45a049;
        }

    </style>

    <div class="dashboard-cards">
        <!-- New Card for Total Transactions -->
        <div class="card">
            <h2>Total Transaksi</h2>
            <p>{{ $totalTransaksiCount }} Transaksi</p>
            <p>Total Margin: Rp {{ number_format($totalMargin, 2) }}</p>
        </div>

        <!-- New Card for Total Keluar Transactions -->
        <div class="card">
            <h2>Total Transaksi Keluar</h2>
            <p>{{ $keluarTransaksiCount }} Transaksi Keluar</p>
            <p>Total: Rp {{ number_format($keluarTransaksiTotal, 2) }}</p>
        </div>

        <!-- New Card for Total Masuk Transactions -->
        <div class="card">
            <h2>Total Transaksi Masuk</h2>
            <p>{{ $masukTransaksiCount }} Transaksi Masuk</p>
            <p>Total: Rp {{ number_format($masukTransaksiTotal, 2) }}</p>
        </div>
    </div>
@endsection
