<?php

use Norm\Schema\String;
use Norm\Schema\Password;
use Norm\Schema\Reference;
use Norm\Schema\Text;

return array(
    'schema' => array(
        'nama_depan'    => String::create('nama_depan')->filter('trim|required')->set('list-column', true),
        'nama_belakang' => String::create('nama_belakang')->filter('trim|required')->set('list-column', true),
        'username'      => String::create('username')->filter('trim|required|unique:User,username'),
        'password'      => Password::create('password')->filter('trim|confirmed|salt'),
        'email'         => String::create('email')->filter('trim|required|unique:User,email')->set('list-column', true),
        'telepon'       => String::create('telepon')->filter('trim')->set('list-column', true),
        'level'         => Reference::create('level')->filter('trim')->to(array('admin' => 'Admin', 'user' => 'User'))->set('list-column', true),
        'alamat'        => Text::create('alamat')->filter('trim')->set('list-column', true),
    ),
);