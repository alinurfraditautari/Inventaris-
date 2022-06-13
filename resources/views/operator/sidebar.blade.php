<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator.dashboard') }}">
    <a href="{{ route('operator.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>

    <li class="{{ set_active('barang') }}">
        <a href="{{ route('barang') }}">
            <i class="fa fa-save"></i> <span>Data Barang</span>
        </a>
    </li>

    <li class="header" style="font-weight:bold;">Data Transaksi Barang</li>
    <li class="{{ set_active('barang.transaksi_masuk') }}">
        <a href="{{ route('barang.transaksi_masuk') }}">
            <i class="fa fa-arrow-left"></i> <span>Transaksi Masuk</span>
        </a>
    </li>
    <li class="{{ set_active('barang.transaksi_keluar') }}">
        <a href="{{ route('barang.transaksi_keluar') }}">
            <i class="fa fa-arrow-right"></i> <span>Transaksi Keluar</span>
        </a>
    </li>

    <li class="{{ set_active('barang.peminjaman') }}">
        <a href="{{ route('barang.peminjaman') }}">
            <i class="fa fa-book"></i> <span>Transaksi Peminjaman</span>
        </a>
    </li>


</li>

<li class="header" style="font-weight:bold;">LAPORAN</li>

<li class="{{ set_active('laporan.barang') }}">
    <a href="{{ route('laporan.barang') }}">
        <i class="fa fa-file-pdf-o"></i> <span>Laporan Data Barang</span>
    </a>
</li>

<li class="{{ set_active('laporan.masuk') }}">
    <a href="{{ route('laporan.masuk') }}">
        <i class="fa fa-file-excel-o"></i> <span>Laporan Barang Masuk</span>
    </a>
</li>

<li class="{{ set_active('laporan.keluar') }}">
    <a href="{{ route('laporan.keluar') }}">
        <i class="fa fa-file-o"></i> <span>Laporan Barang Keluar</span>
    </a>
</li>

<li class="{{ set_active('laporan.peminjaman') }}">
    <a href="{{ route('laporan.peminjaman') }}">
        <i class="fa fa-file-pdf-o"></i> <span>Laporan Peminjaman</span>
    </a>
</li>

<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i>{{__('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>
