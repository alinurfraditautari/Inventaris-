@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Tambah Data Barang
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info text-center">
        <h4>Perhatian!</h4>
        <p>
            Silahkan tambahkan data transaksi keluar untpada form di bawah ini, harap untuk teliti agar tidak terjadi kesalahan dalam proses pengisian data !!
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-left">
                        <a href="{{ route('barang.peminjaman') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Gagal :</strong> {{ $message }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('barang.peminjaman.post') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}

                            <div class="form-group col-md-6" >
                                <label for="exampleInputEmail1">Pilih Barang Terlebih Dahulu</label>
                                <select name="barang_id" id="barang_id" class="form-control">
                                    <option selected disabled>-- pilih salah satu --</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Merk</label>
                                <input type="text" name="merk" id="merk" class="form-control" disabled>
                                <div>
                                    @if ($errors->has('merk'))
                                        <small class="form-text text-danger">{{ $errors->first('merk') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Satuan</label>
                                <select name="satuan" class="form-control" id="satuan" disabled>
                                    <option disabled selected>-- pilih satuan --</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lembar">Lembar</option>
                                </select>
                                <div>
                                    @if ($errors->has('satuan'))
                                        <small class="form-text text-danger">{{ $errors->first('satuan') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Jumlah Pinjam</label>
                                <input type="text" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control">
                                <div>
                                    @if ($errors->has('jumlah_pinjam'))
                                        <small class="form-text text-danger">{{ $errors->first('jumlah_pinjam') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control">
                                <div>
                                    @if ($errors->has('tanggal_pinjam'))
                                        <small class="form-text text-danger">{{ $errors->first('tanggal_pinjam') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control">
                                <div>
                                    @if ($errors->has('tanggal_kembali'))
                                        <small class="form-text text-danger">{{ $errors->first('tanggal_kembali') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nama Peminjam</label>
                                <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control">
                                <div>
                                    @if ($errors->has('nama_peminjam'))
                                        <small class="form-text text-danger">{{ $errors->first('nama_peminjam') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i>&nbsp; Ulangi</button>
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Simpan</button>
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#kelas').DataTable();
        } );

        $(document).on('change','#barang_id',function(){
            var barang_id = $(this).val();
            // alert(barang_id);
            var div = $(this).parent().parent();

            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('transaksi_barang_masuk/cari_barang') }}",
            data:{'barang_id':barang_id},
                success:function(data){
                    $('#barang').show();
                    $('#nama_barang').val(data.nama_barang);
                    $('#kategori').val(data.kategori);
                    $('#satuan').val(data.satuan);
                    $('#merk').val(data.merk);
                },
                error:function(){

                }
            });
        })

        $('#tahun_anggaran').each(function() {
            var year = (new Date()).getFullYear();
            var current = year;
            year -= 20;
            for (var i = 0; i <= 20; i++) {
                if ((year+i) == current)
                    $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
                else
                    $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
        });
    </script>
@endpush
