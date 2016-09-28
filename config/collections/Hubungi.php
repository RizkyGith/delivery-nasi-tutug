<?php

use Norm\Schema\String;
use Norm\Schema\Text;
use Norm\Schema\Date;
use App\Schema\Editor;


return array(
    'schema' => array(

        'nama'        => String::create('nama')->set('list-column', true),
        'email'       => String::create('email')->set('list-column', true),
        'tanggal'     => String::create('tanggal')->set('list-column', true),
        'subjek'      => String::create('subjek')->set('list-column', true),
        'deskripsi'   => Text::create('deskripsi')->set('list-column', true),
        
    ),
);