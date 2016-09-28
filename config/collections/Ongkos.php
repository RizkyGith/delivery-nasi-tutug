<?php 

	
use Norm\Schema\String;
use Norm\Schema\Text;


return array(
    'schema' => array(

        'ongkos'        => String::create('ongkos','Ongkos Kirim')->set('list-column', true),
        'deskripsi'     => Text::create('deskripsi')->set('list-column', true),
        
        
    ),
);