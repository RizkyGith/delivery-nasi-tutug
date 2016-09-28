@extends('skeleton')

@section('content')		
	<img class="imgBannner" src="<?php echo Theme::base('img/7.jpg') ?>" alt="Bono" />
	<div class="wrapper"> 

		<h4 class="sub-title home"> <img width="40px" src="<?php echo Theme::base('img/9.png') ?>" alt="Bono" />&nbsp; Kami Antar Sampai Tujuan</h4>
		<div class="span-12">
			<i class="icn-right xn xn-left-open-mini"></i>Garansi Kualitas <br />
			<p style="border-bottom: 1px dotted #dcdcdc; padding-bottom: 15px;"></p>
			<i class="icn-right xn xn-left-open-mini"></i>Biaya Pengiriman Terjangkau
		</div>	

		<div class="row" style="margin-left: 8px; padding-top: 39px;">
			<div class="span-4">
				<a href="<?php echo URL::base('/index.php/menuMakanan?paket=1'); ?>" style="color: #040404; font-size: 10px; text-decoration:none;">
					<img width="64px" src="<?php echo Theme::base('img/satuan-background.png') ?>" alt="Bono" /> <br />
					Paket Satuan
				 </a>
			</div> 
			<div class="span-4">
				<a href="<?php echo URL::base('/index.php/menuMakanan?paket=2'); ?>" style="color: #040404; font-size: 10px; text-decoration:none;">
					<img width="64px" src="<?php echo Theme::base('img/paket-background.png') ?>" alt="Bono" /> <br />
					Paket Lengkap
				</a>
			</div> 
			<div class="span-4">
				<a href="<?php echo URL::base('/index.php/menuMakanan'); ?>" style="color: #040404; font-size: 10px; text-decoration:none;">
					<img width="64px" src="<?php echo Theme::base('img/lengkap-background.png') ?>" alt="Bono" /> <br />
				    Semua Makanan 
				</a>
			</div> 
		</div>
	</div>

@endsection

