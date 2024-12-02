@extends('pegawai.layouts.app')

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

    <h1>Selamat Datang di Dashboard Pegawai!</h1>
@endsection
