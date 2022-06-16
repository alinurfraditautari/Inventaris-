@php
    use App\Models\TransaksiKeluar;
    use App\Models\Peminjaman;
@endphp
@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Data Barang
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data barang yang sudah tersedia, silahkan tambahkan jika ada barang baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Barang</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('barang.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Berhasil :</strong> {{ $message }}
                        </div>
                    @endif
                    @if($message2 = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Gagal :</strong> {{ $message2 }}
                        </div>
                    @endif
                    <div class="">
                        <table class="table table-bordered table-hover" id="kelas">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah Baik</th>
                                    <th>Jumlah Hilang</th>
                                    <th>Jumlah Rusak</th>
                                    <th>Satuan</th>
                                    <th>Kategori</th>
                                    {{-- <th>Jumlah Barang</th> --}}
                                    <th>Tahun Anggaran</th>
                                    <th>Sumber Dana</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @forelse ($barangs as $barang)
                                @php
                                    $keluar = TransaksiKeluar::where('barang_id',$barang->id)->select(DB::raw('sum(jumlah_keluar) as jumlah_keluar'))->first();
                                    $peminjaman = Peminjaman::where('barang_id',$barang->id)->where('keterangan','sedang_dipinjam')->select(DB::raw('sum(jumlah_pinjam) as jumlah_pinjam'))->first();
                                    if ($keluar->jumlah_keluar == null) {
                                        $jumlah_keluar = 0;
                                    }else {
                                        $jumlah_keluar = $keluar->jumlah_keluar;
                                    }

                                    if ($peminjaman->jumlah_pinjam == null){
                                        $jumlah_pinjam = 0;
                                    }else {
                                        $jumlah_pinjam = $peminjaman->jumlah_pinjam;

                                    }
                                    $minus = $keluar->jumlah_keluar + $jumlah_pinjam;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->merk }}</td>
                                    <td>
                                        <b>{{ $barang->jumlah_baik - $minus }} {{ $barang->satuan }}</b><br>
                                        <label class="text-warning">Catatan : <br> {{ $jumlah_pinjam }} sedang dipinjam</label>
                                    </td>
                                    <td>{{ $barang->jumlah_hilang }}</td>
                                    <td>{{ $barang->jumlah_rusak }}</td>
                                    <td>{{ $barang->satuan }}</td>
                                    <td>
                                        @if ($barang->kategori == "aset")
                                            Kategori Aset
                                        @else
                                            Kategori Barang Habis Pakai
                                        @endif
                                    </td>

                                    <td>{{ $barang->tahun_anggaran }}</td>
                                    <td>
                                        @if ($barang->sumber_dana == "apbn")
                                            Anggaran Pendapatan dan Belanja Negara (APBN)
                                        @else
                                            Penerima Negara Bukan Pajak (PNBP)
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('barang.edit',[$barang->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                        <form action="{{ route('barang.delete',[$barang->id]) }}" method="POST">
                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp; Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center"><label class="text-danger">Data Barang Tidak Tersedia</label></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#kelas').DataTable( {
            responsive: true,
        } );
    } );
    </script>
@endpush
