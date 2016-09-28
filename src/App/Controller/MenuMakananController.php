<?php

namespace App\Controller;

use \Norm\Norm;
use \Norm\Controller\NormController;
use \Bono\Helper\URL;

class MenuMakananController extends NormController 
{
    //* mapRoute
    public function mapRoute()
    {
        parent::mapRoute();

        $this->map('/:id/keranjang', 'keranjang')->via('GET');  
        $this->map('/:id/:ongkos/:totalkeranjang/:totalKeselurahanUser/jumlahKeseluruhan', 'jumlahKeseluruhan')->via('GET');  
        $this->map('/:id/pilihanKeranjang', 'pilihanKeranjang')->via('GET');  
        $this->map('/null/keranjangBelanja', 'keranjangBelanja')->via('GET');  
        $this->map('/:id/isiForm', 'isiForm')->via('GET');  
        $this->map('/null/totalBiaya', 'totalBiaya')->via('GET');  
        $this->map('/null/createForm', 'createForm')->via('POST', 'GET');  
        $this->map('/null/selesaiBelanja', 'selesaiBelanja')->via('GET');  
        $this->map('/null/ketentuan', 'ketentuan')->via('GET');  
        $this->map('/null/totalBelanja', 'totalBelanja')->via('GET');  
        $this->map('/:id/deleteKeranjang', 'deleteKeranjang')->via('GET', 'POST');  

    }



    public function deleteKeranjang ($id) {

        $id_user = $_SESSION['user']['$id'];
        $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => '1'));
        $jumlahKeranjang = count($keranjang);

        if ($this->request->isPost() || $this->request->isDelete()) {
                $single = false;

            if (count($id) === 1) {
                $single = true;
            }

            try {
                $this->data['entries'] = array();

                    $model = Norm::factory('Keranjang')->findOne($id);

                    // var_dump($model); exit();

                    if (is_null($model)) {
                        if ($single) {
                            $this->app->notFound();
                        }

                        continue;
                    }

                    if ($jumlahKeranjang === 1) {
                        $model->remove();

                        // redirect
                        $url = URL::site('menuMakanan/');
                        h('notification.info', 'Keranjang kosong.');
                        $this->app->redirect($url);
                    } else {
                        $model->remove();

                        // redirect
                        $sisaBelanja = $jumlahKeranjang-1;
                        $url = URL::site('/menuMakanan/null/keranjangBelanja');
                        h('notification.info', 'Keranjang belanja anda sisa' .' '.$sisaBelanja. '.');
                        $this->app->redirect($url);
                    }

            } catch (Stop $e) {
                throw $e;
            } catch (Exception $e) {
                h('notification.error', $e);

                if (empty($model)) {
                    $model = null;
                }

                h('controller.delete.error', array(
                    'error' => $e,
                    'model' => $model,
                ));
            }
         }

        $this->data['id'] = $id;
    }

    public function totalBelanja () {

        $userCreate = Norm::factory('User')->newInstance();

        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        $hari = $array_hari[date('N')];

        $id_user = $_SESSION['user']['$id'];
        $user = Norm::factory('User')->findOne($id_user);

        $nama             = $user['nama_depan'].' '.$user['nama_belakang'];
        $tlp              = $user['telepon'];
        $tgl_pesan        = $hari.', '.date('m-d-Y'); 
        $jam              = date('h:i:s a');
        $jenis_pembayaran = $_GET['jenis_pembayaran'];
        $keterangan       = $_GET['keterangan'];
        $total            = $_GET['total'];
        $status           = 'Proses Pengiriman';

        if (!empty($_GET['alamat'] == 'red')) {
            $alamat = $_GET['alamatAnda'];
        } else {
            $alamat = $_GET['alamatLain'];
        }

        $userCreate->set('id_user', $id_user);
        $userCreate->save();

        $url = URL::site('null/selesaiBelanja/');
        h('notification.info', 'Masuk List Belanja');
        $this->app->redirect($url);

    }

    public function ketentuan () {

        $id_user = $_SESSION['user']['$id'];
        $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 1));


        foreach ($keranjang as $key => $value) {
            
            $value->set('status', '2');
            $value->save();

        }

    }

    public function selesaiBelanja () {

        //* form user keranjang *\\ 
        $userCreate = Norm::factory('Pesan')->newInstance();

        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        $hari = $array_hari[date('N')];

        $id_user = $_SESSION['user']['$id'];
        $user = Norm::factory('User')->findOne($id_user);

        $nama             = $user['nama_depan'].' '.$user['nama_belakang'];
        $tlp              = $user['telepon'];
        $tgl_pesan        = $hari.', '.date('m-d-Y'); 
        $jam              = date('h:i:s a');
        $jenis_pembayaran = $_GET['jenis_pembayaran'];
        $keterangan       = $_GET['keterangan'];
        $total            = $_GET['total'];

        $status           = 'Baru Pesan';

        if (!empty($_GET['alamat'] == 'red')) {
            $alamat = $_GET['alamatAnda'];
        } else {
            $alamat = $_GET['alamatLain'];
        }

        $userCreate->set('id_user', $id_user);
        $userCreate->set('nama_pemesan', $nama);
        $userCreate->set('telepon', $tlp);
        $userCreate->set('alamat', $alamat);
        $userCreate->set('keterangan', $keterangan);
        $userCreate->set('tgl_pesan', $tgl_pesan);
        $userCreate->set('jam', $jam);
        $userCreate->set('status', $status);
        $userCreate->set('jumlah', $total);
        $userCreate->set('jenis_pembayaran', $jenis_pembayaran);
        $userCreate->set('bulan', date('n'));
        $userCreate->set('tahun', date('Y'));
        $userCreate->save();

        // -------------------------------------------------------------

        $pesan  = Norm::factory('Pesan')->findOne(array('id_user' => $id_user, 'status' => 'Baru Pesan'));
        $profil = Norm::factory('Profil')->findOne();

        $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 1));
        $this->data['keranjang'] = $keranjang;

        foreach ($keranjang as $key => $qty) {
            $qty = $qty['qty'];
            $this->data['qty'] = $qty;

            // var_dump($ve); 
        }
        // exit();

        $readMakanan = array();

        $totalKeranjang = 0;

        foreach ($keranjang as $key => $value) {
            
            $makanan = Norm::factory('Makanan')->find(array('id' => $value['id_makanan']))->toArray();

            $ongkos = Norm::factory('Ongkos')->findOne();
            $this->data['ongkos'] = $ongkos;

            foreach ($makanan as $key => $v) {
            //-- banyak makananan di dikalikan dengan harga  ditambah dengan ongkos  
            $makananStok = $value['qty'] * $v['harga'];

            $totalKeranjang += $makananStok;
                
            array_push($readMakanan, array('nama'=> $v['nama'], 'harga' => $v['harga'], 'stok' => $v['stok']));
                
            }
        }

        $jumlah = $pesan['jumlah'] + $id_user;

        $this->data['jumlah'] = $jumlah;
        $this->data['id_user'] = $id_user;
        $this->data['profil'] = $profil;
        $this->data['pesan'] = $pesan;
        $this->data['readMakanan'] = $readMakanan;

       
    }

    public function createForm () {

        // if (isset($_POST)) {
        //     $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 1));

        //     foreach ($keranjang as $key => $value) {

        //         var_dump($value);

        //         // $value->set('status', 2);
        //         // $keranjang->save();
        //         // var_dump($keranjang); 

        //     }

        //     exit();
             // exit();

        // }

        //* id user
        // if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user"):
            $id_user = $_SESSION['user']['$id'];
        $pesan = Norm::factory('Pesan')->newInstance();

        $pesan->set('id_user', $id_user);
        $pesan->set('nama_pemesan', $_POST['nama_pemesan']);
        $pesan->set('telepon',  $_POST['telepon']);
        $pesan->set('alamat',  $_POST['alamat']);
        $pesan->set('keterangan',  $_POST['keterangan']);
        $pesan->set('tgl_pesan',  $_POST['tgl_pesan']);
        $pesan->set('jam',  $_POST['jam']);
        $pesan->set('status',  $_POST['status']);
        $pesan->set('jumlah',  $_POST['jumlah']);
        $pesan->set('jenis_pembayaran',  $_POST['jenis_pembayaran']);
        // var_dump($pesan); exit();

        $pesan->save();

        // $url = URL::site('pesan/null/selesaiBelanja');

        // http://localhost/1127/www/index.php/menuMakanan/null/selesaiBelanja

        // var_dump($url); exit();

        $url = ( f('controller.url', '/null/selesaiBelanja') );
        h('notification.info', 'Terima Kasih Sudah Daftar');
        $this->app->redirect($url);

        // $refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        // h('notification.info', 'Terima Kasih sudah mengisi form');
        // $this->redirect($refering_url);
    }

    public function isiForm ($totalKeselurahan) {
        $this->data['totalKeselurahan'] = $totalKeselurahan;        
    }


    public function totalBiaya() {
    }

    public function jumlahKeseluruhan ($jumlah, $ongkos, $totalkeranjang, $totalKeselurahanUser)
    {
        $profil = Norm::factory('Profil')->findOne();

        $this->data['jumlah'] = $jumlah;
        $this->data['ongkos'] = $ongkos;
        $this->data['totalkeranjang'] = $totalkeranjang;
        $this->data['profil'] = $profil;
        $this->data['totalKeselurahanUser'] = $totalKeselurahanUser;
        
    }

    public function keranjangBelanja() {

        //* id user
        // if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user"):
        $id_user = $_SESSION['user']['$id'];

        $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 1));
        $this->data['keranjang'] = $keranjang;

        // $qty = Norm::factory('Keranjang')->find(array('id_user' => $id_user));

        $readMakanan = array();

        $totalKeranjang = 0;

        foreach ($keranjang as $key => $value) {
            
            $makanan = Norm::factory('Makanan')->find(array('id' => $value['id_makanan']))->toArray();

            $ongkos = Norm::factory('Ongkos')->findOne();
            $this->data['ongkos'] = $ongkos;

            foreach ($makanan as $key => $v) {
            //-- banyak makananan di dikalikan dengan harga  ditambah dengan ongkos  
            $makananStok = $value['qty'] * $v['harga'];

            // var_dump($makananStok);

            $totalKeranjang += $makananStok;
                
            array_push($readMakanan, array('nama'=> $v['nama'], 'picture' => $v['picture'], 'id_kategori' => $v['id_kategori'], 'harga' => $v['harga'], 'stok' => $v['stok'], 'qty' => $value['qty'], 'jumlahStok' => $makananStok, 'id_makanan' => $value['$id']));
                
            }

        }

        //* total belanja di + dengan ongkos kirim penanda + id user
        $totalKeselurahan = $totalKeranjang + $ongkos['ongkos'];
        $totalKeselurahanUser = $totalKeranjang + $ongkos['ongkos'] + $id_user;

        //-- total belanja --\\
        $this->data['makananStok'] = $makananStok;
        $this->data['totalKeranjang'] = $totalKeranjang;
        $this->data['totalKeselurahan'] = $totalKeselurahan;
        $this->data['totalKeselurahanUser'] = $totalKeselurahanUser;

        $this->data['readMakanan'] = $readMakanan;

        
    }

    //-- keranjang popup --\\
    public function pilihanKeranjang ($id) {
    }

    public function keranjang ($id) {

        //* id user
            $id_user = $_SESSION['user']['$id'];

        $keranjang = Norm::factory('Keranjang')->newInstance();

        $keranjang->set('id_user', $id_user);

        $keranjang->set('status', 1);

        $keranjang->set('id_makanan', $id); 

        //-- qty get --\\
        if (isset($_GET)) {
            $keranjang->set('qty', $_GET['qty']); 
        }

        $keranjang->save();

        $url = ( f('controller.url', '/null/keranjangBelanja') );
        h('notification.info', 'Masuk Ke keranjang');
        $this->app->redirect($url);

        // $refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        // h('notification.info', 'Masuk Ke keranjang');
        // $this->redirect($refering_url);

    }

    public function search () {
        
        //* session id
        if (!empty($_SESSION['user'])) {
            $id = $_SESSION['user']['$id'];
            $this->data['id'] = $id;
        }

        if (isset($_GET['paket'])) {
            $entries = Norm::factory('Makanan')->find(array('id_kategori' => $_GET['paket']))->limit($this->getLimit());
        }

        if (isset($_GET['search'])) {
            $entries = Norm::factory('Makanan')->find(array('nama!like' => $_GET['search']))->limit($this->getLimit());
        } 

        if (empty($_GET)) {
            $entries = Norm::factory('Makanan')->find($this->getCriteria())
                ->match($this->getMatch())
                ->sort($this->getSort())
                ->skip($this->getSkip())
                ->limit($this->getLimit());
        }

        $this->data['entries'] = $entries;
        
        }

}
