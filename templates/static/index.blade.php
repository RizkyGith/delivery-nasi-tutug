@extends('skeleton')

@section('content')
		
		@if ($_SESSION['user']['level'] && $_SESSION['user']['level'] == 'user') 
		
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
							<a href="<?php echo URL::base('/index.php/menuMakanan?paket=Satuan'); ?>" style="color: #040404; font-size: 10px; text-decoration:none;">
								<img width="64px" src="<?php echo Theme::base('img/satuan-background.png') ?>" alt="Bono" /> <br />
								Paket Satuan
							 </a>
						</div> 
						<div class="span-4">
							<a href="<?php echo URL::base('/index.php/menuMakanan?paket=Paket'); ?>" style="color: #040404; font-size: 10px; text-decoration:none;">
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

		
			
		@endif

		@if ($_SESSION['user']['level'] && $_SESSION['user']['level'] == 'admin') 
			<div class="wrapper">
				<h1 class="title" style="font-size: 18px;">Hello, Admin</h1>
				
				<div class="row">
					<div class="dashboard">
						<div class="row">
							<div class="span-3">
								<div class="wrapper">
									<div class="item highlight">
										<span class="icn xn xn-user"></span>
										<div class="count-big">
											<h2>654</h2>
											<h6 class="label">User</h6>
										</div>
									</div>
								</div>
							</div>
							<div class="span-3">
								<div class="wrapper">
									<div class="item highlight success">
										<span class="icn xn xn-chart-area"></span>
										<div class="count-big">
											<h2>145 K</h2>
											<h6 class="label">Transaksi</h6>
										</div>
									</div>
								</div>
							</div>
							<div class="span-3">
								<div class="wrapper">
									<div class="item highlight warning">
										<span class="icn xn xn-basket"></span>
										<div class="count-big">
											<h2>331</h2>
											<h6 class="label">Order</h6>
										</div>
									</div>
								</div>
							</div>
							<div class="span-3">
								<div class="wrapper">
									<div class="item highlight error">
										<span class="icn xn xn-doc-text"></span>
										<div class="count-big">
											<h2>56</h2>
											<h6 class="label">Laporan</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</div>
		@endif


	
@endsection

@section('contextual')
@endsection