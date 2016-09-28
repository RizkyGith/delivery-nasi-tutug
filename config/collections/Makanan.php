<?php

use Norm\Schema\String;
use Norm\Schema\Text;
use Norm\Schema\Reference;
use Norm\Schema\Integer;
use App\Schema\Upload;

return array(
    'schema' => array(

        'nama'         => String::create('nama','Nama Makanan')->set('list-column', true),
        'harga'        => Integer::create('harga')->set('list-column', true),
        'stok'         => Integer::create('stok')->set('list-column', true),
        'id_kategori'  => Reference::create('id_kategori','kategori')->to('Kategori','nama')->set('list-column', true),
        'deskripsi'    => Text::create('deskripsi')->set('list-column', true),
        'picture'      => Upload::create('picture'),

    ),
);