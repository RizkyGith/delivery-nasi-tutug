@extends('skeleton')

@section('content')
    <div class="wrapper">
        <h4 class="sub-title">Riwayat Pembelian</h1>

        <p>
            Kumpulan <strong> Riwayat Pembelian </strong> Anda :
        </p>

        <style type="text/css">
            .even {
                padding-top: 0px;
                color:#294362;
            }

            .xn.xn-down-open-mini {
                padding: 6px 14px;
            }

        </style>

        <ol class="">
            @foreach ($readMakanan as $value) 
                <li class="even"> 
                    <a href="#demo{{ $value['id'] }}" data-toggle="collapse" style="text-decoration:none;">  {{ $value['tgl_pesan'] }} | {{ $value['jam'] }}  <i class="xn xn-down-open-mini"></i>
                    @if (!empty($value['status'] == 'Baru Pesan')) 
                        <span class="badge solid round error" style="background: #434D5D; margin-left: 229px; margin-top: -88px; width: 21px;">  <i class="xn xn-docs" style="margin-left: -4px;"></i> </span>
                    @endif
                    </a>  
                </li> 
                    <div id="demo{{ $value['id'] }}" class="collapse">
                        <!-- <ul> -->

                            <?php 
                                
                                // $id_user = $_SESSION['user']['$id'];
                                // $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 2, '_updated_time' => $value['_updated_time']));

                                // foreach ($keranjang as $key => $val) {
                                    
                                //     $makanan = Norm::factory('Makanan')->find(array('$id' => $val['id_makanan']));

                                //     foreach ($makanan as $key => $v) {
                                        
                                        // echo "<li>" .$v['nama']. "</li>";
                                //     }
                                // }

                             ?>

                        <!-- </ul> <hr /> -->
                        <div>

                            @if ($value['status'] == 'Baru Pesan')
                                <a href="" style="color:#f44336;"> <b>  Status : {{ $value['status'] }} </b> </a> <br />
                            @else 
                                <a href=""> <b>  Status : {{ $value['status'] }} </b> </a> <br />
                            @endif

                            <?php 
                                $id_user = $_SESSION['user']['$id'];
                                $jumlah = $value['jumlah'] + $id_user;
                             ?>
                            <strong>Total Pembayaran : Rp. {{ number_format($jumlah) }} </strong> <br />
                        </div>
                    </div>
                </li> 
            @endforeach
        </ol>
    </div> 
    
@endsection

@section('contextual')
   <ul class="pagination centered">
        <li><a href="#"><i class="xn xn-angle-double-left"></i></a></li>
        <li><a href="#"><i class="xn xn-left-open-big"></i></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        
        <li class="unavailable"><a href="#">…</a></li>
        <li><a href="#">9</a></li>
        <li><a href="#">10</a></li>
        
        <li><a href="#"><i class="xn xn-right-open-big"></i></a></li>
        <li><a href="#"><i class="xn xn-angle-double-right"></i></a></li>
    </ul> <br /> <br /> <br />
  @endsection