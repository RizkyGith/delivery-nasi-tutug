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
        
    <div class="wrapper" style="padding: 45px 18px;">
        <div style="padding-top: 7px;">
            <h4 class="sub-title" style=" padding-bottom: 12px;color: #150101; font-weight: 500; line-height: 126%; border-bottom: 1px solid #c6d5e7; font-size: 18px;"> <i class="xn xn-vcard" style="color: #F95C5C;"></i> Form Data</h4>
        </div>

        <?php 
            $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
            $hari = $array_hari[date('N')];
        ?>

        <style type="text/css">

            input[type=text] {
                border: 0;
                outline: 0;
                background: transparent;
                border-bottom: 1px solid #c6d5e7;
            }

        </style>

    <form method="post" id="createform" class="read" action="{{ f('controller.url', '/null/createForm') }}">
        <div class="row" style="padding-top: 19px;">

            <div class="span-12">
                <label> Nama Pemesan* </label>
                <input type="text" name="nama_pemesan" required>
            </div>

            <div class="span-12">
                <label> No Telepon* </label>
                <input type="text" name="telepon" required>
                <!-- //* tgl pesan -->
                <input type="hidden" name="tgl_pesan" value="<?php echo $hari; ?>, <?php echo date('m-d-Y'); ?>">
                <input type="hidden" name="jam" value="<?php echo date('h:i:s a'); ?>">
            </div>

            <div class="span-12">
                <label> Alamat Lengkap* </label>
                <textarea name="alamat" style="border: 0; outline: 0;background: transparent;border-bottom: 1px solid #c6d5e7;" required></textarea>
            </div>

            <div class="span-12">
                <label> Keterangan* </label>
                <textarea name="keterangan" style="border: 0; outline: 0;background: transparent;border-bottom: 1px solid #c6d5e7;"></textarea>
                <!-- //-- hidden to status -->
                <input type="hidden" name="status" value="Proses Pengiriman">
                <input type="hidden" name="jumlah" value="{{ $totalKeselurahan }}">
            </div>

            <div class="span-12"> <br />
                <label> Jenis Pembayaran* </label> <br /> <br />
                <label>Transfer</label>  &nbsp;
                <input type="radio" name="jenis_pembayaran" value="Transfer" required> &nbsp; &nbsp;
                <label>Bayar Ditempat</label> &nbsp;
                <input type="radio" name="jenis_pembayaran" value="Bayar Ditempat" required>
            </div> 
            
            <div class="span-12"> 
                <center>  <br /> <br />
                    <button type="submit" class="badge" style="padding: 9px;"> Simpan Data Jika Sudah Benar </button>  
                </center>

                <center>
                    <p style="margin-top: 22px; font-size: 12px;"> <i class="xn xn-left-open-mini"></i> Kembali ke <a href="{{ f('controller.url', '/null/keranjangBelanja') }}">keranjang</a>  </p> 
                </center>
            </div> 

        </div>
@stop


