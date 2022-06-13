@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Edit Data Transaksi Masuk
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info text-center">
        <h4>Perhatian!</h4>
        <p>
            Silahkan tambahkan data transaksi pada form di bawah ini, harap untuk teliti agar tidak terjadi kesalahan dalam proses pengisian data !!
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-left">
                        <a href="{{ route('barang.transaksi_keluar') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('barang.transaksi_keluar.update',[$transaksi->id]) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}" readonly id="barang_id" class="form-control">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Kode Barang</label>
                            <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}" readonly id="kode_barang" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" readonly id="nama_barang" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Merk</label>
                            <input type="text" name="merk" value="{{ $barang->merk }}" readonly id="merk" class="form-control">
                            <div>
                                @if ($errors->has('merk'))
                                    <small class="form-text text-danger">{{ $errors->first('merk') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Jumlah Keluar</label>
                            <input type="text" name="jumlah_keluar" value="{{ $transaksi->jumlah_keluar }}" id="jumlah_keluar" class="form-control">
                            <div>
                                @if ($errors->has('jumlah_keluar'))
                                    <small class="form-text text-danger">{{ $errors->first('jumlah_keluar') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" value="{{ $transaksi->tanggal_keluar }}" id="tanggal_keluar" class="form-control">
                            <div>
                                @if ($errors->has('tanggal_keluar'))
                                    <small class="form-text text-danger">{{ $errors->first('tanggal_keluar') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Tujuan Keluar</label>
                            <textarea name="tujuan_keluar" class="form-control" id="" cols="30" rows="3">{{ $transaksi->tujuan_keluar }}</textarea>
                            <div>
                                @if ($errors->has('tanggal_keluar'))
                                    <small class="form-text text-danger">{{ $errors->first('tanggal_keluar') }}</small>
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
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#kelas').DataTable();
        } );

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

        $(document).on('change','#anggota_id',function(){
            var anggota_id = $(this).val();
            var div = $(this).parent().parent();
            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('operator/simpanan_wajib/cari_bulan') }}",
            data:{'anggota_id':anggota_id},
                success:function(data){
                    op+='<option value="0" selected disabled>-- pilih bulan --</option>';
                    for(var i=0; i<data.length;i++){
                        // alert(data[i].id);
                        // alert(data['jenis_publikasi'][i].anggota_id);
                        op+='<option value="'+data[i].bulan_transaksi+'">'+data[i].bulan_transaksi+'</option>';
                    }
                    div.find('#bulan').html(" ");
                    div.find('#bulan').append(op);
                },
                    error:function(){
                }
            });
        })
    </script>
@endpush
