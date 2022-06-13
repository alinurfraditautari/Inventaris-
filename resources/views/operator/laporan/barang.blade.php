@php
    use App\Models\TransaksiKeluar;
    use App\Models\Peminjaman;
@endphp
@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Laporan Data Barang
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data barang yang sudah tersedia, silahkan cetak data dalam bentuk excel / pdf
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-file-pdf-o"></i>&nbsp;Laporan Data Barang</h3>
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
                                <th>Merk</th>
                                <th>Kategori</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan</th>
                                <th>Tahun Anggaran</th>
                                <th>Sumber Dana</th>
                                <th>Kondisi</th>
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
                                    @if ($barang->kategori == "aset")
                                        Kategori Aset
                                    @else
                                        Kategori Barang Habis Pakai
                                    @endif
                                </td>
                                <td>
                                    {{ $barang->jumlah_barang - $minus }}
                                </td>
                                <td>{{ $barang->satuan }}</td>
                                <td>{{ $barang->tahun_anggaran }}</td>
                                <td>
                                    @if ($barang->sumber_dana == "apbn")
                                        Anggaran Pendapatan dan Belanja Negara (APBN)
                                    @else
                                        Penerima Negara Bukan Pajak (PNBP)
                                    @endif
                                </td>
                                <td>
                                    @if ($barang->kondisi == "baik")
                                        <label class="text-success"><i class="fa fa-check-circle"></i>&nbsp;Kondisi Baik</label>
                                    @elseif ($barang->kondisi == "rusak")
                                        <label class="text-warning"><i class="fa fa-warning"></i>&nbsp;Sudah Rusak</label>
                                    @elseif ($barang->kondisi == "hilang")
                                        <label class="text-danger"><i class="fa fa-close"></i>&nbsp;Hilang</label>
                                    @else
                                        <label class="text-info"><i class="fa fa-info-circle"></i>&nbsp;Sedang Dipinjam</label>
                                    @endif
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
