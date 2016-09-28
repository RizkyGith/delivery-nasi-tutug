@extends('shared/create')

<?php use ROH\Util\Inflector; ?>

@section('pagetitle')
    {{ l('{0}: ', array(Inflector::humanize(f('controller')->getClass()))).$entry->format() }}
@stop

@section('back')
    <ul class="flat left">
        <li><a href="{{ f('controller.url') }}"><i class="xn xn-left-open"></i>{{ l('Back') }}</a></li>
    </ul>
@stop

@section('fields')
    <form class="read">
        <h2> Detail Order</h2> <hr>
        
        <div class="row">
            <div class="table-container">

            <div class="wrapper" style="padding: 6px;">
            <paper-detail class="">
            <div class="row">
                <div class="span-6">
                    <row class="">
                        <label>Tanggal & Jam</label>
                        <info class="">{{ $entry['tgl_pesan'] }}  | {{ $entry['jam'] }}</info>
                    </row>
                </div>
                <div class="span-4">
                    <row>
                    <form action="{{'controller.url', '/'.$entry['$id']}}">
                        

                        <label>Status Order</label>
                        <select name='status' style="width: 156px; height: 28px; padding: 1px 5px;">
                            <option>---</option>
                            <option <?php if ($order['status']=='Baru Pesan') { echo "selected"; } ?>>Baru Pesan</option>
                            <option <?php if ($order['status']=='Proses Pengiriman') { echo "selected"; } ?>>Proses Pengiriman</option>
                            <option <?php if ($order['status']=='Terkirim') { echo "selected"; } ?>>Terkirim</option>
                        </select>
                    </form>
                    </row>
                </div>
                <div class="span-2">
                    <row>
                        <div>
                            <button class="solid info">Ubah Status</button>
                        </div>
                    </row>
                </div>
            </div>
            </div>
        </paper-detail>
    </div>
            <h2>Rincian Pembelian</h2> <hr >
                <table class="table nowrap">
                    <thead>
                        <tr>
                            <th>Nama Makanan</th>
                            <th> <center>Jumlah Pembelian</center> </th>
                            <th style="text-align:right">Harga Satuan</th>
                            <th style="text-align:right">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($readMakanan as $value)

                        <tr>
                            <td>{{ $value['nama'] }}</td>
                            <td> <center> {{ $value['qty'] }} </center> </td>
                            <td style="text-align:right"> {{ number_format($value['harga']) }} </td>
                            <td style="text-align:right"> {{ number_format($value['jumlahStok']) }} </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="3" style="text-align:right"> Total Rp. </p></td>
                            <td style="text-align:right"> <b> {{  number_format($entry['jumlah']) }} </b> </p></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right"> Ongkos Kirim Rp. </p></td>
                            <td style="text-align:right"> <b>  {{ number_format($ongkir['ongkos']) }} </b> </p></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right"> Grand Total Rp. </p></td>
                            <td style="text-align:right"> <b> {{ number_format($grandTotal) }} </b> </p></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right"> <a style="color:#CF4741"> Total Yang Dikirim Oleh Pemesan Rp. </a> </td>
                            <td style="text-align:right"> <a style="color:#CF4741"> <b> {{ number_format($totalDikirim) }} </b> </a></td>
                        </tr>
                    </tbody>
                </table>

            <h2>Data Kustomer</h2> <hr >
                <paper-detail class="">
            <div class="row">
                <div class="span-6">
                    <row class="">
                        <label class="">Nama Kustomer</label>
                        <info class="">{{ $user['nama_depan'] }} {{ $user['nama_belakang'] }}</info>
                    </row>
                    <row class="">
                        <label>No Telepon/HP</label>
                        <info class=""> {{ $user['telepon'] }} </info>
                    </row>
                </div>
                <div class="span-6">
                    <row>
                        <label>Email</label>
                        <info>{{ $user['email'] }}</info>
                    </row>
                    <row>
                        <label>Alamat Pengiriman</label>
                        <info>{{ $entry['alamat'] }}</info>
                    </row>
                </div>
            </div>
            </div>
        </paper-detail>
                
            </div>
        </div>
     
    </form>
@stop

@section('contextual.content')
    <nav class="row">
        <div class="pull-left">
            <a href="{{ f('controller.url', '/:id/delete') }}" class="button error popup noclose modal"><i class="xn xn-trash"></i>{{{ l('Delete') }}}</a>
        </div>
        <div class="pull-right">&nbsp;</div>
    </nav>
@stop