<?php

use Norm\Schema\String;
use Norm\Schema\Integer;
use Norm\Schema\Reference;
use Norm\Schema\Date;



return array(
    'schema' => array(

        'id_nama'      => Reference::create('id_nama','Nama')->to('User','username')->set('list-column', true),     
        'tgl_order'    => Date::create('tgl_order', 'Tanggal Order')->set('list-column', true),
        'jam'          => String::create('jam')->set('list-column', true),
        'status'       => String::create('status')->set('list-column', true),
        'id_makanan'   => Reference::create('id_makanan','Nama Makanan')->to('Makanan','nama'),
        'jumlah'       => Integer::create('jumlah'),
        'harga'        => Integer::create('harga'),
        'id_ongkos'    => Reference::create('id_ongkos','Ongkos Kirim')->to('Ongkos','ongkos'),
        
    ),
);