@extends('skeleton')

<?php 
    use ROH\Util\Inflector;
    use App\Library\Pagination;
    use Norm\Schema\Reference;
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
        <h4 class="sub-title custom"> <i class="xn xn-basket" style="color: #F95C5C;"></i> Keranjang Belanja</h4>

        <div class="row custom">

        @foreach ($readMakanan as $key => $value) 

        
            <div class="span-6">
                <img class="cart" src="<?php echo Theme::base('data/makanan/'.$value['picture']); ?>"> <br />
            </div>

            
            <div class="span-6">
                <p class="nameKeranjang">{{ ucfirst($value['nama']) }} </p>
                <p class="categoryKeranjang">Kategori : {{ Reference::create('id_kategori', 'Kategori')->to('Kategori', 'nama')->format('plain', $value['id_kategori']) }} </p>
            </div>

            <div class="span-12">
                <div class="span-3">
                    <p class="hargaKeranjang">Rp. {{ number_format($value['harga']) }}</p>
                </div>

                <div class="span-3">
                    <p class="qtyKeranjang"> Qty : {{ $value['qty'] }}</p>
                </div>

                <div class="span-5">
                    <p class="totalKeranjang">Rp. {{ number_format($value['jumlahStok']) }}</p>
                </div>

                <div class="span-1">
                   <a href="{{ f('controller.url', '/'. $value['id_makanan'] .'/deleteKeranjang') }}" class="popup"> <p class="deleteKeranjang"><i class="xn xn-cancel custom"></i></p> </a>                      
                </div>
            </div> 

            <div class="span-12">
                <hr />
            </div>

        @endforeach


             <div class="span-12">
                <ol class="">
                    <li class="even first-child odd nostyle"> 
                        <a href="#demo" data-toggle="collapse" style="text-decoration: none; margin-left: -26px; font-size: 14px;">  <i class="xn xn-docs"></i> Form Pelanggan   
                            <div class="pull-right">
                                  <i class="xn xn-down-open-big"></i> 
                            </div>
                        </a>
                    </li> 
                    <div class="span-12">
                        
                    <div id="demo" class="collapse">
                        <form action="{{ f('controller.url', '/null/selesaiBelanja') }}" method="GET">
                            <div class="span-12" style="margin: 17px 1px -2px -6px;">
                                <label> Jenis Pembayaran* </label> <br />
                                <input type="radio" name="jenis_pembayaran" value="Transfer" required>
                                <a>Transfer</a> &nbsp;
                                <input type="radio" name="jenis_pembayaran" value="Bayar Ditempat" required>
                                <a>Bayar Ditempat</a>  &nbsp; <br /> <br />
                            </div> 

                            <div>
                                <label style="margin-left: -5px;"> Alamat Pengiriman </label> <br />
                                <div style="margin-left: -5px;">
                                    <input type="radio" name="alamat" value="red"> <a> Alamat Anda </a> &nbsp; 
                                    <input type="radio" name="alamat" value="green">  <a> Alamat Lain </a> <br /> <br />
                                </div>
                            </div>
                            
                            <div class="red box">
                                <div class="span-12" style="margin-left: -5px;">
                                    <textarea name="alamatAnda"><?php echo $_SESSION['user']['alamat']; ?></textarea> <br />
                                </div>
                            </div>

                            <div class="green box">
                                <div class="span-12" style="margin-left: -5px;">
                                    <textarea name="alamatLain" placeholder="Alamat Lengkap"></textarea> <br />
                                </div>
                            </div>

                            <div class="span-12" style="margin-left: -5px;">
                                <label style="margin-left: -5px;">Keterangan</label>
                                <textarea name="keterangan" placeholder="Pemesanan / Alamat / dll" style="margin-left: -5px;"></textarea>
                                <!-- //* Total Pembelian -->
                                <input type="hidden" name="total" value="{{ $totalKeranjang }}">
                            </div>

                            <div class="span-12" style="margin-left: -5px; padding-top: 14px;">
                                <div class="pull-right">
                                    <button type="submit" class="badge">Selesai Belanja</button> 
                                </div>
                            </div>

                        </form>        
                    </div>
                </ol> <hr />
            </div>  <br />


            <div class="span-12 custom">
                <div class="pull-right">
                    <p class="subtotalKeranjang">Total Belanja : Rp. {{ number_format($totalKeranjang) }}</p>
                </div>
            </div>

            <div class="span-12">
                <div class="span-7">
                    <a class="lanjutKeranjang" href="{{ f('controller.url') }}"> <i class="xn xn-basket customKeranjang"></i> Lanjutkan Belanja</a>  
                    <!-- <a class="atauKeranjang">atau</a> -->
                </div>
                <div class="span-5">
                    <div class="pull-right">
                        <!-- <button type="submit" class="badge">Selesai Belanja</button> 
                        </form> -->
                        <!-- <a href="{{ f('controller.url', '/' .number_format($totalKeselurahan). '/' .number_format($ongkos['ongkos']). '/' .number_format($totalKeranjang). '/' .$totalKeselurahanUser. '/jumlahKeseluruhan') }}" class="badge popup"> Selesai Belanja </a> -->
                    </div>
                </div>
            </div>

        </div>

    </div>

@stop


