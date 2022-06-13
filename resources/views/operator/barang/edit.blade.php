@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Edit Data Barang
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
                        <a href="{{ route('barang') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('barang.update',[$barang->id]) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="form-control">
                            <div>
                                @if ($errors->has('nama_barang'))
                                    <small class="form-text text-danger">{{ $errors->first('nama_barang') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Merk</label>
                            <input type="text" name="merk" value="{{ $barang->merk }}" class="form-control">
                            <div>
                                @if ($errors->has('merk'))
                                    <small class="form-text text-danger">{{ $errors->first('merk') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Kategori Barang</label>
                            <select name="kategori" class="form-control" id="bulan">
                                <option disabled selected>-- pilih kategori --</option>
                                <option {{ $barang->kategori == "aset" ? 'selected' : '' }} value="aset">Aset</option>
                                <option {{ $barang->kategori == "barang_habis_pakai" ? 'selected' : '' }} value="barang_habis_pakai">Barang Habis Pakai</option>
                            </select>
                            <div>
                                @if ($errors->has('kategori'))
                                    <small class="form-text text-danger">{{ $errors->first('kategori') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Jumlah Barang</label>
                            <input type="text" name="jumlah_barang" value="{{ $barang->jumlah_barang }}" class="form-control">
                            <div>
                                @if ($errors->has('jumlah_barang'))
                                    <small class="form-text text-danger">{{ $errors->first('jumlah_barang') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Satuan</label>
                            <select name="satuan" class="form-control" id="bulan">
                                <option disabled selected>-- pilih satuan --</option>
                                <option {{ $barang->satuan == "Unit" ? 'selected' : '' }} value="Unit">Unit</option>
                                <option {{ $barang->satuan == "Pcs" ? 'selected' : '' }} value="Pcs">Pcs</option>
                                <option {{ $barang->satuan == "Lembar" ? 'selected' : '' }} value="Lembar">Lembar</option>
                            </select>
                            <div>
                                @if ($errors->has('satuan'))
                                    <small class="form-text text-danger">{{ $errors->first('satuan') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Tahun Anggaran</label>
                            <select name="tahun_anggaran" id="tahun_anggaran" class="form-control @error('tahun_anggaran') is-invalid @enderror"></select>
                            <div>
                                @if ($errors->has('tahun_anggaran'))
                                    <small class="form-text text-danger">{{ $errors->first('tahun_anggaran') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Sumber Dana</label>
                            <select name="sumber_dana" class="form-control" id="sumber_dana">
                                <option disabled selected>-- pilih sumber dana --</option>
                                <option {{ $barang->sumber_dana == "apbn" ? 'selected' : '' }} value="apbn">Anggaran Pendapatan dan Belanja Negara (APBN)</option>
                                <option {{ $barang->sumber_dana == "pnpb" ? 'selected' : '' }} value="pnpb">Penerima Negara Bukan Pajak (PNBP)</option>
                            </select>
                            <div>
                                @if ($errors->has('sumber_dana'))
                                    <small class="form-text text-danger">{{ $errors->first('sumber_dana') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Kondisi Barang</label>
                            <select name="kondisi" class="form-control" id="kondisi">
                                <option disabled selected>-- pilih kondisi barang --</option>
                                <option {{ $barang->kondisi == "baik" ? 'selected' : '' }} value="baik">Baik</option>
                                <option {{ $barang->kondisi == "rusak" ? 'selected' : '' }} value="rusak"> Rusak</option>
                                <option {{ $barang->kondisi == "hilang" ? 'selected' : '' }} value="hilang"> Hilang</option>
                            </select>
                            <div>
                                @if ($errors->has('kondisi'))
                                    <small class="form-text text-danger">{{ $errors->first('kondisi') }}</small>
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
