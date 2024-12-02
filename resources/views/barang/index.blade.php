<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <style>
        /* Global Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            padding: 10px 20px;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .brand {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }

        .navbar .login-btn {
            background-color: white;
            color: #4CAF50;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar .login-btn:hover {
            background-color: #45a049;
            color: white;
        }

        /* Main Content Styling */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        #search-bar {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        th a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
        }

        th a span {
            margin-left: 5px;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        #pagination {
            margin-top: 20px;
            text-align: center;
        }

        #pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #4CAF50;
        }

        #pagination a.active {
            font-weight: bold;
            color: #333;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#" class="brand">Tokotani</a>
        <a href="/login">
            <button class="login-btn">Login</button>
        </a>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1>Daftar Barang</h1>
        <input type="text" id="search-bar" placeholder="Cari barang..." value="{{ request('search') }}">
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="#" class="sortable" data-sort="nama_barang">
                            Nama Barang
                            <span class="sort-icon" id="icon-nama_barang">⬍</span>
                        </a>
                    </th>
                    <th>
                        <a href="#" class="sortable" data-sort="deskripsi">
                            Deskripsi
                            <span class="sort-icon" id="icon-deskripsi">⬍</span>
                        </a>
                    </th>
                    <th>
                        <a href="#" class="sortable" data-sort="stok">
                            Stok
                            <span class="sort-icon" id="icon-stok">⬍</span>
                        </a>
                    </th>
                    <th>
                        <a href="#" class="sortable" data-sort="harga_jual">
                            Harga Jual
                            <span class="sort-icon" id="icon-harga_jual">⬍</span>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody id="barang-table">
                @forelse ($barangs as $barang)
                    <tr>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->deskripsi }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada barang ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div id="pagination">
            {{ $barangs->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let sort_by = '{{ request("sort_by", "nama_barang") }}';
            let order = '{{ request("order", "asc") }}';

            updateSortIcons();

            // Handle search input
            $('#search-bar').on('keyup', function () {
                fetchData();
            });

            // Handle sorting
            $('.sortable').on('click', function (e) {
                e.preventDefault();
                sort_by = $(this).data('sort');
                order = order === 'asc' ? 'desc' : 'asc';
                fetchData();
            });

            // Fetch data dynamically
            function fetchData() {
                const search = $('#search-bar').val();

                $.ajax({
                    url: '{{ route('barang.index') }}',
                    data: {
                        search: search,
                        sort_by: sort_by,
                        order: order
                    },
                    success: function (response) {
                        $('#barang-table').html($(response.table).find('#barang-table').html());
                        $('#pagination').html($(response.table).find('#pagination').html());
                        updateSortIcons();
                    }
                });
            }

            // Update sort icons
            function updateSortIcons() {
                $('.sort-icon').text('⬍'); // Default icon
                $(`#icon-${sort_by}`).text(order === 'asc' ? '⬆' : '⬇'); // Update active column
            }
        });
    </script>
</body>
</html>
