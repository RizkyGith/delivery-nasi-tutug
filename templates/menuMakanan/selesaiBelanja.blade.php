@extends('skeleton')

<?php 
    use ROH\Util\Inflector;
    use App\Library\Pagination;
 ?>

<?php
$schema = array();
foreach (f('controller')->schema() as $key => $field) {
    if ($field['list-column']) {
        $schema[$key] = $field;
    }
}
?>

@section('pagetitle')
   {{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}
@stop


@section('tabssearch')
@stop

@section('menu')
@stop

@section('content')
        
    <div class="wrapperCustom">
        <h4 class="sub-title custom"> <i class="xn xn-basket" style="color: #F95C5C;"></i> Selesai Belanja </h4>

        <div class="span-12" style="">
            <ol class="">
                <li class="even first-child odd nostyle"> 
                    <a href="#demo" data-toggle="collapse" style="text-decoration: none; margin-left: -26px; font-size: 16px;">  <i class="xn xn-doc-text"></i> Rincian Belanja 
                        <div class="pull-right">
                              <i class="xn xn-down-open-big"></i> 
                        </div>
                    </a> 
                </li>

                <div id="demo" class="collapse" style="margin-left: -15px; padding-top: 11px;">
                    <ol>
                        @foreach ($readMakanan as $key => $value)
                            <li class="first-child odd"> {{ $value['nama'] }} : Rp. {{ number_format($value['harga']) }} </li>
                        @endforeach
                        
                        <!-- //* jika user melakukan pembayaran ditempat -->
                        @if (!empty($pesan['jenis_pembayaran'] == 'Bayar Ditempat')) 
                            <br />
                            <li style="color:#337ab7;"> <a> Ongkos Kirim : {{ number_format($ongkos['ongkos'])}} </a> </li>
                        @endif

                    </ol> <hr />
                    <!-- //* total keseluruhan -->
                    <?php
                        $jumlahAll = $ongkos['ongkos'] + $pesan['jumlah'] + $id_user;

                        if (!empty($pesan['jenis_pembayaran'] == 'Transfer')) {
                            $jumlah = $pesan['jumlah'] + $id_user;
                        } else {
                            $jumlah = $ongkos['ongkos'] + $pesan['jumlah'];
                        }
                    ?>
                    &nbsp;&nbsp;<strong> TOTAL BELANJA : Rp. {{ number_format($jumlah) }}</strong> 

                </div>
            </ol>
        </div> <br />

        <!-- <p style="font-size: 16px; color: #337ab7;"> <i class="xn  xn-cc-by"></i> Alamat  Pengiriman </p> -->

        <div class="span-12">
            <div class="row" style="margin-left: 0px; padding-top: 12px;">
                <div class="span-12">
                    <b> No Order : <a> {{  date('d').date('m').$id_user }} </a> </b>
                </div>
                <!-- <div class="span-5">
                    <div class="pull-left" style="margin-left: -22px;">
                        &nbsp; <a> {{  date('d').date('m').$id_user }} </a>
                    </div> 
                </div> -->
            </div>
        </div>

        <div class="span-12">
            <div class="row" style="margin-left: 0px; padding-top: 12px;">
                <div class="span-12">
                    <b> No Rekening &nbsp;: <a> {{ $profil['no_rekening'] }} </a> </b>
                </div>
                <!-- <div class="span-5" style=" margin-left: -17px;">
                    &nbsp; <a> {{ $profil['no_rekening'] }} </a>
                </div> -->
            </div>
        </div>

        <div class="span-12">
            <div class="row" style="margin-left: 0px; padding-top: 12px;">
                <div class="span-12">
                    <b> Jenis Pembayaran : <a> {{ $pesan['jenis_pembayaran'] }} </a> </b>
                </div>
                <!-- <div class="span-5" style=" margin-left: -3px;">
                    <a> {{ $pesan['jenis_pembayaran'] }} </a>
                </div> -->
            </div>
        </div>

        <div class="span-12">
            <div class="row" style="margin-left: 0px; padding-top: 12px;">
                    @if (!empty($pesan['jenis_pembayaran'] == 'Transfer')) 
                        <div class="span-12">
                            <b> Jumlah Total Transfer : <a> Rp. {{ number_format($jumlah) }} </a> </b>
                        </div>
                        <!-- <div class="span-4" style=" margin-left: -18px;">
                            <a> Rp. {{ number_format($jumlah) }} </a>
                        </div> -->
                    @else 
                        <div class="span-12">
                            <b> Total Pembayaran : <a> Rp. {{ number_format($jumlahAll) }} </a> </b>
                        </div>
                        <!-- <div class="span-4" style=" margin-left: -18px;">
                            <a> &nbsp;&nbsp;&nbsp; Rp. {{ number_format($jumlahAll) }} </a>
                        </div> -->
                    @endif
            </div>
        </div>

        <div class="span-12">
            <p style="padding-top: 29px; font-weight: bold;"> Ketentuan Pembelian </p> <hr />
            <p style="text-align:justify;">
                 Untuk jenis pembayaran dengan Bank Transfer, Anda harus mengirim Ke No Rekening <b> <a>{{ $profil['no_rekening'] }}</a> </b>,
                 Atas Nama <b> <a>Mizwar Hartono </a> </b>, segera lakukan pembayaran maksimum 1 jam setelah pemesanan, jika belum melakukan transfer waktu yang telah ditentukan maka pesanan di anggap gagal.
            </p>
        </div>

        <div class="span-12">
            <div class="pull-right" style="padding-top: 6px;">
                <a href="{{ f('controller.url', '/null/ketentuan') }}" class="badge"> Selesaikan Belanja </a>
            </div>
        </div>


    </div>
    
@stop


