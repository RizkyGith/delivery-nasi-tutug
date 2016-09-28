<?php

/**
 * Bono App Configuration
 *
 * @category  PHP_Framework
 * @package   Bono
 * @author    Ganesha <reekoheek@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/xinix-technology/bono/master/LICENSE MIT
 * @version   0.10.0
 * @link      http://xinix.co.id/products/bono
 */

use Norm\Schema\String;
use Norm\Schema\Password;

return array(
    'application' => array(
        'title' => 'Bono',
        'subtitle' => 'One great application'
    ),
    'bono.timezone' => 'Asia/Jakarta',
    'bono.prettifyURL' => false,
    'bono.salt' => 'please change this',
    'bono.theme' => array(
        'class' => 'Xinix\\Theme\\Jacket',
        'overwrite' => true,
    ),
    'bono.providers' => array(
        'Norm\\Provider\\NormProvider' => array(
            'datasources' => array(
                // 'mongo' => array(
                //     'driver' => 'Norm\\Connection\\MongoConnection',
                //     'database' => 'collega-website',
                // ),

                'mysql' => array(
                    'driver'   => '\\Norm\\Connection\\PDOConnection',
                    'dialect'  => '\\Norm\\Dialect\\MySQLDialect',
                   
                    'prefix'   => 'mysql',
                    'dbname'   => 'delivery',
                    'host'     => 'localhost',
                    // 'host'     => '192.168.1.10', // server dev xinix
                    'username' => 'root',
                    'password' => 'password',

                    /*'prefix'   => 'mysql',
                    'dbname'   => 'collega-website',
                    'host'     => 'localhost',
                    'username' => 'root',
                    'password' => 'password',*/
                ),
            ),
            'collections' => array(
                'default' => array(
                    // The observer, more like a hook event
                    'observers' => array(
                        'Norm\\Observer\\Ownership',
                        'Norm\\Observer\\Timestampable',
                    ),

                    // Limit the entries that shown, then paginate them
                    'limit' => 10,
                ),

                // Resolver to find where the schemas config stored see in /config/collections folder
                'resolvers' => array(
                    'Norm\\Resolver\\CollectionResolver',
                ),
            ),
        ),
        'Bono\\Provider\\LanguageProvider' => null,
        // 'App\\Provider\\AppProvider',

        'App\\Provider\\AppProvider'=> array(
            'Upload_Directory' => dirname(__DIR__).'/www/data/makanan'// set directory for upload on application 
        ),
    ),
    'bono.middlewares' => array(
        'Bono\\Middleware\\StaticPageMiddleware' => null,
        'Bono\\Middleware\\ControllerMiddleware' => array(
            'default' => 'Norm\\Controller\\NormController',
            'mapping' => array(

                //* frond end
                '/profil'             => null,
                '/caraPembelian'      => null,
                '/menuMakanan'        => '\\App\\Controller\\MenuMakananController',
                '/keranjangPembelian' => null,
                '/hubungiKami'        => null,
                '/riwayat'            => '\\App\\Controller\\RiwayatController',
                '/login'              => null,
                '/register'           => null,

                //* back end
                '/dashboard'    => null,
                '/profil'       => '\\App\\Controller\\profilController',
                '/kategori'     => null,
                '/makanan'      => null,
                '/ongkos'       => null,
                '/hubungi'      => null,
                '/laporan'      => null,
                '/pesan'        => '\\App\\Controller\\PesanController',
                '/user'         => null,

/*

                '/icons' => null,
                '/table' => null,
                '/list' => null,
                '/grid' => null,
                '/detail' => null,
                '/user' => null,
                '/form' => null,
                '/role' => null,*/
            ),
        ),
        // uncomment below to enable auth
        // 'Xinix\\BonoAuth\\Middleware\\AuthMiddleware' => array(
        //     'driver' => 'Xinix\\BonoAuth\\Driver\\NormAuth',
        // ),
         'Xinix\\BonoAuth\\Middleware\\AuthMiddleware' => array(
            'driver' => 'Xinix\\BonoAuth\\Driver\\NormAuth',
            'driver' => 'App\\Driver\\MemberAuth',
        ),
        'Bono\\Middleware\\NotificationMiddleware' => null,
        'Bono\\Middleware\\SessionMiddleware' => null,
        'Bono\\Middleware\\ContentNegotiatorMiddleware' => array(
            'extensions' => array(
                'json' => 'application/json',
            ),
            'views' => array(
                'application/json' => 'Bono\\View\\JsonView',
            ),
        ),
    ),
);
