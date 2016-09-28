<?php

use Norm\Schema\String;
use Norm\Schema\Text;
use Norm\Schema\Reference;
/*use App\Schema\Upload;*/
use App\Schema\Editor;

return array(
    'schema' => array(

        'nama'        => String::create('nama','Nama Toko')->set('list-column', true),
        'email'       => String::create('email', 'Email Pengelola')->set('list-column', true),
        'telepon'     => String::create('telepon', 'No Telepon')->set('list-column', true),
        'no_rekening' => String::create('no_rekening')->set('list-column', true),
      /*  'picture'     => Upload::create('picture'),*/
        'deskripsi'   => Editor::create('deskripsi')->set('list-column', true),
        
    ),
);