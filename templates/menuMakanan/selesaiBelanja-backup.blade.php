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
        
    <div class="wrapper">
        <h4 class="sub-title" style=" padding-bottom: 12px; color: #F95C5C; font-weight: 500; line-height: 126%; border-bottom: 1px solid #c6d5e7; font-size: 14px;"> <i class="xn xn-basket"></i> Selesai Belanja</h4>
    </div>

    <div class="wrapper">
        <div class="row">
        
            1. No Order : {{ date('d') }}{{ $_SESSION['user']['$id'] }}{{ date('m') }} <br />
            2. Jumlah yang harus di bayar : Rp. {{ number_format($pesan['jumlah']) }} <br />
            3. No Rekening : {{ $profil['no_rekening'] }} <br />
            4. Jenis Pembayaran :  {{ $pesan['jenis_pembayaran'] }} <br />
            ----------------------------------------- <br />
            5. List Pembelian Belanja : <br />

            @foreach ($readMakanan as $key => $value)
                 <li> {{ $value['nama'] }} || {{ number_format($value['harga']) }} ||  <!-- {{ $qty }} --> ||   </li> 
            @endforeach 

            <br />
            <a href="{{ f('controller.url', '/null/ketentuan') }}" class="badge">  Apakah anda setuju </a>


                <!-- foreach ($makanan as $key => $v) { -->

        </div>
    </div>
    
@stop


