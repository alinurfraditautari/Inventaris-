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
            Berikut adalah data transaksi keluar barang yang sudah tersedia, silahkan tambahkan jika ada transaksi keluar yang baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Transaksi Keluar</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('barang.transaksi_keluar.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
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
                                <th>Tanggal Keluar</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Satuan</th>
                                <th>Tujuan Keluar</th>
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
                                <td>{{ $transaksi->tanggal_keluar }}</td>
                                <td>{{ $transaksi->kode_barang }}</td>
                                <td>{{ $transaksi->nama_barang }}</td>
                                <td>{{ $transaksi->jumlah_keluar }}</td>
                                <td>{{ $transaksi->satuan }}</td>
                                <td>{{ $transaksi->tujuan_keluar }} </td>
                                <td>
                                    <a href="{{ route('barang.transaksi_keluar.edit',[$transaksi->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                    <form action="{{ route('barang.transaksi_keluar.delete',[$transaksi->id]) }}" method="POST">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp; Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center"><label class="text-danger">Data Transaksi Keluar Tidak Tersedia</label></td>
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
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#kelas').DataTable( {
            buttons: [ 'excel', 'pdf' ],
            dom:
            "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu:[
                [10,25,50,100,-1],
                [10,25,50,100,"All"]
            ]
        } );

        table.buttons().container()
            .appendTo( '#kelas_wrapper .col-md-5:eq(0)' );
    } );
    </script>
@endpush
