@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Transaksi Masuk
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data transaksi masuk barang yang sudah tersedia, silahkan tambahkan jika ada transaksi masuk yang baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Transaksi Masuk</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('barang.transaksi_masuk.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
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
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Baik</th>
                                <th>Jumlah Rusak</th>
                                <th>Jumlah Hilang</th>
                                <th>Satuan</th>
                                <th>Sumber Dana</th>
                                <th>Tahun Anggaran</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @forelse ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $transaksi->kode_barang }}</td>
                                <td>{{ $transaksi->nama_barang }}</td>
                                <td>{{ $transaksi->jumlah_baik }}</td>
                                <td>{{ $transaksi->jumlah_rusak }}</td>
                                <td>{{ $transaksi->jumlah_hilang }}</td>
                                <td>{{ $transaksi->satuan }}</td>
                                <td>{{ $transaksi->sumber_dana }}</td>
                                <td>{{ $transaksi->tahun_anggaran }}</td>
                                <td>{{ $transaksi->tanggal_masuk }}</td>
                                <td>
                                    <a href="{{ route('barang.transaksi_masuk.edit',[$transaksi->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                    <form action="{{ route('barang.transaksi_masuk.delete',[$transaksi->id]) }}" method="POST">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp; Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center"><label class="text-danger">Data Transaksi Masuk Tidak Tersedia</label></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#kelas').DataTable( {

        } );
    } );
    </script>
@endpush
