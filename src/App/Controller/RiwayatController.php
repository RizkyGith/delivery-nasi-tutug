<?php

namespace App\Controller;

use \Norm\Norm;
use \Norm\Controller\NormController;
use \Bono\Helper\URL;

class RiwayatController extends NormController 
{

    //* mapRoute
    public function mapRoute()
    {
        parent::mapRoute();

        $this->map('/null/laporan', 'laporan')->via('GET');
        $this->map('/null/transaksi', 'transaksi')->via('GET');
        // $this->map('/null/selesai', 'selesai')->via('GET');
  
    }

    public function search () {

        $id_user = $_SESSION['user']['$id'];

        $riwayat = Norm::factory('Pesan')->find(array('id_user' => $id_user));
        $this->data['riwayat'] = $riwayat;

        $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 2));
        $this->data['keranjang'] = $keranjang;

        $readMakanan = array();
        foreach ($riwayat as $key => $value) {

            foreach ($keranjang as $key => $v) {
                
                $makanan = Norm::factory('Makanan')->find(array('$id' => $v['id_makanan']));

            }
                    array_push($readMakanan, array('id' => $value['$id'], 'nama_pemesan' => $value['nama_pemesan'], 'tgl_pesan' => $value['tgl_pesan'], 'jam' => $value['jam'], 'jumlah' => $value['jumlah'], 'status' => $value['status'], 'id_makanan' => $v['$id'], '_updated_time' => '2016-09-21 09:12:59'));

                    // var_dump($readMakanan); 
        }
                // exit();
                // $this->data['makanan'] = $makanan;

        // exit();

        $this->data['readMakanan'] = $readMakanan;

        // $readMakanan = array();

        // $totalKeranjang = 0;

        // foreach ($keranjang as $key => $value) {
            
        //     $makanan = Norm::factory('Makanan')->find(array('id' => $value['id_makanan']))->toArray();

        //     foreach ($makanan as $key => $v) {
        //     //-- banyak makananan di dikalikan dengan harga  ditambah dengan ongkos  
        //     $makananStok = $value['qty'] * $v['harga'];

        //     // var_dump($makananStok);

        //     $totalKeranjang += $makananStok;
                
        //     array_push($readMakanan, array('nama'=> $v['nama'], 'picture' => $v['picture'], 'id_kategori' => $v['id_kategori'], 'harga' => $v['harga'], 'stok' => $v['stok'], 'qty' => $value['qty'], 'jumlahStok' => $makananStok, 'id_makanan' => $value['$id']));
                
        //     }

        // }

        // //-- total belanja --\\
        // $this->data['makananStok'] = $makananStok;
        // $this->data['totalKeranjang'] = $totalKeranjang;
        // $this->data['readMakanan'] = $readMakanan;
        
    }

}