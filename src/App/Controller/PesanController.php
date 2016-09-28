<?php

namespace App\Controller;

use \Norm\Norm;
use \Norm\Controller\NormController;
use \Bono\Helper\URL;
use \App\Report\ReportExport;

class PesanController extends NormController 
    {
    //* mapRoute
    public function mapRoute()
    {
        parent::mapRoute();

        $this->map('/null/laporan', 'laporan')->via('GET');
        $this->map('/null/transaksi', 'transaksi')->via('GET');
        $this->map('/null/popupExport', 'popupExport')->via('GET', 'POST');
  
    }

    function popupExport ()
    {
    }    

    function selesaiBelanja ()
    {
        // var_dump('expression'); exit();
    }

    public function transaksi() {

        //* pencarian search ny belum di sortir
        $months = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli ', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November',  '12' => 'Desember');
        $this->data['monthlist'] = $months;

        //* pencarian / search
        $startdateSearch = 2015;
        $enddateSearch = 2020;
        $yearSearch = range($startdateSearch, $enddateSearch);
        $this->data['yearSearch'] = $yearSearch;


        //-- day order --\\
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        $hari = $array_hari[date('N')];
        $hari = $hari; 
        $tgl  = date('m-d-Y');

        // var_dump($hari.','.' '.$_GET['transaksi-hari-ini'] ); exit();

        $entries = Norm::factory('Pesan')->find(array('tgl_pesan' => $hari.','.' '.$_GET['transaksi-hari-ini'], 'status' => 'Terkirim'));
        // $entries = Norm::factory('Pesan')->find();
        
        // var_dump($entries); exit();

        $this->data['entries'] = $entries;

        //* report excel
        if (isset($_GET['!export'])) {

            //* sementara cuy
            $entries = Norm::factory('Pesan')->find(array('tgl_pesan' => $hari.','.' '.$_GET['date']));

            //* link rel report exel
            $report = ReportExport::create($this->app);
            $field = array();
            //* jika data nya null belum
            foreach ($entries as $key => $entry) {
                $datas[] = $entry->toArray();
            }

            $report->excelExportTransaksi($datas,$field,'Report');
        }
    	
    }

    public function laporan() {

        //* pencarian search ny belum di sortir

        $months = array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli ', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November',  '12' => 'Desember');
        $this->data['monthlist'] = $months;

        //* pencarian / search
        $startdateSearch = 2015;
        $enddateSearch = 2020;
        $yearSearch = range($startdateSearch, $enddateSearch);
        $this->data['yearSearch'] = $yearSearch;

        if (isset($_GET['month'])) {
            $entries = Norm::factory('Pesan')->find(array('bulan' => $_GET['month'], 'tahun' => $_GET['year'], 'status' => 'Terkirim'));
        } else {
            $entries = Norm::factory('Pesan')->find(array('status' => 'Terkirim'));
        }

        $this->data['entries'] = $entries;

         //* report excel
        if (isset($_GET['!export'])) {

            //* link rel report exel
            $report = ReportExport::create($this->app);
            $field = array();
            //* jika data nya null belum
            foreach ($entries as $key => $entry) {
                $datas[] = $entry->toArray();
            }

            $report->excelExportLaporan($datas,$field,'Report');
        }
    }

    // public function read($id){

    //     $this->data['entry'] = $entry = $this->collection->findOne($id);

    //     // sementara status 1, harus nya 2

    //     $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $entry['id_user'], 'status' => 1));
    //     $this->data['keranjang'] = $keranjang;

    //     $readMakanan = array();
    //     $totalKeranjang = 0;

    //     foreach ($keranjang as $key => $value) {
            
    //         $makanan = Norm::factory('Makanan')->find(array('id' => $value['id_makanan']))->toArray();

    //         foreach ($makanan as $key => $v) {
    //         //-- banyak makananan di dikalikan dengan harga  ditambah dengan ongkos  
    //         $makananStok = $value['qty'] * $v['harga'];
    //         $this->data['makananStok'] = $makananStok;

    //         // var_dump($makananStok);

    //         $totalKeranjang += $makananStok;
                

                
    //         }
            
    //         array_push($readMakanan, array('nama'=> $v['nama'], 'picture' => $v['picture'], 'id_kategori' => $v['id_kategori'], 'harga' => $v['harga'], 'stok' => $v['stok'], 'qty' => $value['qty'], 'jumlahStok' => $makananStok, 'id_makanan' => $value['$id']));

    //         var_dump($readMakanan);

    //         exit();
    //     }


    //     //-- total belanja --\\
    //     $this->data['totalKeranjang'] = $totalKeranjang;

    //     $this->data['readMakanan'] = $readMakanan;

    //     // --------------------------------------------

    //     $order=Norm::factory('Pesan')->findOne($id);
    //     $this->data['order']=$order;

    //     $ongkir = Norm::factory('Ongkos')->findOne();
    //     $this->data['ongkir'] = $ongkir;

    //     if (!empty($_GET)) {

    //         $order=Norm::factory('Pesan')->findOne($id);
    //         $this->data['order']=$order;
        
    //         $order->set('status', $_GET['status']);

    //         $order->save();

    //         $url = URL::site('pesan/'.$id);        
    //         h('notification.info', 'Status update');
    //         $this->app->redirect($url);
    //     } 

    //     $user = Norm::factory('User')->findOne($entry['id_user']);        
    //     $grandTotal = $entry['jumlah'] + $ongkir['ongkos'];
    //     $totalDikirim = $grandTotal + $entry['id_user'];

    //     $this->data['user'] = $user;
    //     $this->data['grandTotal'] = $grandTotal;
    //     $this->data['totalDikirim'] = $totalDikirim;
        

    // }
     public function read($id){

        $this->data['entry'] = $entry = $this->collection->findOne($id);

        // sementara status 1, harus nya 2 => makasih ya allah swt

        $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $entry['id_user'], 'status' => 2));
        $this->data['keranjang'] = $keranjang;

        $readMakanan = array();

        $totalKeranjang = 0;

        foreach ($keranjang as $key => $value) {
            
            $makanan = Norm::factory('Makanan')->find(array('id' => $value['id_makanan']))->toArray();

            foreach ($makanan as $key => $v) {
            //-- banyak makananan di dikalikan dengan harga  ditambah dengan ongkos  
            $makananStok = $value['qty'] * $v['harga'];

            // var_dump($makananStok);

            $totalKeranjang += $makananStok;
                
            array_push($readMakanan, array('nama'=> $v['nama'], 'picture' => $v['picture'], 'id_kategori' => $v['id_kategori'], 'harga' => $v['harga'], 'stok' => $v['stok'], 'qty' => $value['qty'], 'jumlahStok' => $makananStok, 'id_makanan' => $value['$id']));
                
            }

        }

        //-- total belanja --\\
        $this->data['makananStok'] = $makananStok;
        $this->data['totalKeranjang'] = $totalKeranjang;

        $this->data['readMakanan'] = $readMakanan;

        // --------------------------------------------

        $order=Norm::factory('Pesan')->findOne($id);
        $this->data['order']=$order;

        $ongkir = Norm::factory('Ongkos')->findOne();
        $this->data['ongkir'] = $ongkir;

        if (!empty($_GET)) {

            $order=Norm::factory('Pesan')->findOne($id);
            $this->data['order']=$order;
        
            $order->set('status', $_GET['status']);

            $order->save();

            $url = URL::site('pesan/'.$id);        
            h('notification.info', 'Status update');
            $this->app->redirect($url);
        } 

        $user = Norm::factory('User')->findOne($entry['id_user']);        
        $grandTotal = $entry['jumlah'] + $ongkir['ongkos'];
        $totalDikirim = $grandTotal + $entry['id_user'];

        $this->data['user'] = $user;
        $this->data['grandTotal'] = $grandTotal;
        $this->data['totalDikirim'] = $totalDikirim;
        

    }

}