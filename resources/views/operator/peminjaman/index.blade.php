@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Transaksi Peminjaman
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data transaksi peminjaman barang yang sudah tersedia, silahkan tambahkan jika ada transaksi peminjaman yang baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Transaksi Peminjaman</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('barang.peminjaman.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Baru</a>
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
                                <th>Tanggal Pinjam</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Pinjam</th>
                                <th>Jumlah Kembali</th>
                                <th>Jumlah Rusak</th>
                                <th>Jumlah Hilang</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Keterangan</th>
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
                                <td>{{ $transaksi->tanggal_pinjam }}</td>
                                <td>{{ $transaksi->kode_barang }}</td>
                                <td>{{ $transaksi->nama_barang }}</td>
                                <td>{{ $transaksi->jumlah_pinjam }} {{ $transaksi->satuan }}</td>
                                <td>{{ $transaksi->kondisi_pengembalian_baik }} {{ $transaksi->satuan }}</td>
                                <td>{{ $transaksi->kondisi_pengembalian_rusak }} {{ $transaksi->satuan }}</td>
                                <td>{{ $transaksi->kondisi_pengembalian_hilang }} {{ $transaksi->satuan }}</td>
                                <td>{{ $transaksi->nama_peminjam }}</td>
                                <td>{{ $transaksi->tanggal_kembali }} </td>
                                <td>
                                    @if ($transaksi->keterangan == "sedang_dipinjam")
                                        <label class="text-warning"><i class="fa fa-clock-o"></i>&nbsp; Sedang Dipinjam</label>
                                    @elseif ($transaksi->keterangan == "belum_tuntas")
                                        <label class="text-info"><i class="fa fa-warning"></i>&nbsp; Belum Tuntas</label>
                                    @else
                                        <label class="text-success"><i class="fa fa-check-circle"></i>&nbsp; Sudah Dikembalikan</label>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('barang.peminjaman.update',[$transaksi->id]) }}" method="POST">
                                        {{ csrf_field() }} {{ method_field('PATCH') }}
                                        <div class="form-group">
                                            <label for="">Status Pengembalian</label>
                                            <select name="keterangan"  class="form-control" id="keterangan" {{ $transaksi->keterangan == "sudah_dikembalikan" ? 'disabled' : '' }}>
                                                <option disabled selected>-- pilih keterangan -- </option>
                                                <option value="belum_tuntas">Belum Tuntas</option>
                                                <option value="sudah_dikembalikan">Sudah Dikembalikan</option>
                                            </select>
                                        </div>
                                        <div style="display: none" id="form-keterangan">
                                            <div class="form-group" >
                                                <label for="">Jumlah Baik</label>
                                                <input type="text" name="kondisi_pengembalian_baik" id="">
                                            </div>
                                            <div class="form-group" >
                                                <label for="">Jumlah Hilang</label>
                                                <input type="text" name="kondisi_pengembalian_hilang" id="">
                                            </div>
                                            <div class="form-group" >
                                                <label for="">Jumlah Rusak</label>
                                                <input type="text" name="kondisi_pengembalian_rusak" id="">
                                            </div>
                                            <div class="form-group" >
                                                <label for="">Keterangan Pengembalian</label>
                                                <textarea name="keterangan_pengembalian" class="form-control" id="keterangan_pengembalian" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <button class="btn btn-success btn-sm" {{ $transaksi->keterangan == "sudah_dikembalikan" ? 'disabled' : '' }}><i class="fa fa-check-circle"></i>&nbsp; Update</button>
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
<script>
    $(document).ready(function() {
        var table = $('#kelas').DataTable( {

        } );
    } );

    $(document).ready(function() {
        $('#keterangan').change(function() {
            var keterangan = $('#keterangan').val();
            if (keterangan == "belum_tuntas") {
                $('#form-keterangan').show();
            }else{
                $('#form-keterangan').hide();
            }
        })
    } );
    </script>
@endpush
