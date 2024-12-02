<!-- resources/views/owner/components/sidebar.blade.php -->
<div class="sidebar">
    <div class="toggle-btn">&#9776;</div>
    <ul>
        <li><a href="{{ route('owner.dashboard') }}">Dashboard</a></li>
        <li><a href="#">Kelola Pegawai</a></li>
        <li><a href="#">Kelola Transaksi</a></li>
        <li><a href="#">Kelola Barang</a></li>
        <li><a href="#">Kelola Barang Masuk</a></li>
        <li><a href="#">Kelola Barang Keluar</a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
