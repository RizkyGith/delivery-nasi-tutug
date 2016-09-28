<?php

use Norm\Schema\String;
use Norm\Schema\Text;


return array(
    'schema' => array(

        'nama'        => String::create('nama','Nama Kategori')->set('list-column', true),
        'deskripsi'   => Text::create('deskripsi')->set('list-column', true),
        
    ),
);