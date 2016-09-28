<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>
			@section('pagetitle')
				{{ f('page.title', 'Dashboard') }}
			@show
			- Bono
		</title>
		<meta name="description" content="{{ f('page.title', 'Great App') }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo Theme::base('img/favicon.ico') ?>" type="image/x-icon">

		<link href="<?php echo Theme::base('css/app.min.css') ?>" rel="stylesheet">

		@section('customcss')
			<link href="<?php echo Theme::base('css/custom.css') ?>" rel="stylesheet">
			@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 	
				<link rel="stylesheet" type="text/css" href="<?php echo Theme::base('css/jquery-ui.css') ?>">
				<link rel="stylesheet" type="text/css" href="<?php echo Theme::base('css/bootstrap.min.css') ?>">

			@endif
		@show
		
		<script type="text/javascript" src="<?php echo Theme::base('js/app.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo Theme::base('js/custom.js') ?>"></script>
		@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 	
			<script type="text/javascript" src="<?php echo Theme::base('js/bootstrap.min.js') ?>"></script>
		@endif

		<script type="text/javascript" src="<?php echo Theme::base('vendor/tinymce/tinymce.min.js') ?>"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="<?php echo Theme::base('js/app.ie.min.js') ?>"></script>
		<![endif]-->
	</head>

	<body class="@section('has-sidebar')
			has-sidebar
		@show">
		@section('skeleton')
			<!--[if lt IE 7]>
			@section('iewarning')
				<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http:browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
			@show
			<![endif]-->

			@section('notification')
				{{ f('notification.show') }}
			@show

			@section('topbar')

			@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")
				<nav class="nav-menu">
			@endif

			@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 
				<nav class="nav-menu" style="background:#f44336;">
			@endif
					<div class="pull-left">
						<h1>
							@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 
								<a style="padding: 15px 0px;" id="nav-toggle" href="<?php echo URL::site() ?>"> <span></span> </a>
								<!-- ------------------------------------------------------------------------------------ -->
							@endif

							@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")
								<a href="<?php echo URL::base() ?>">
								@section('applogo')
									<span class="logo">
										@section('applogo.image')
											<img src="<?php echo Theme::base('img/bono.png') ?>" alt="Bono" />
										@show
									</span>
									<span style="font-size: 19px;">
										@section('applogo.title')
											Nasi Tutug Oncom
										@show
									</span>
								@show
							@endif

							</a>

							@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 
								<h6 style="margin: 8px 0px 0px 29px; color: #FFF;"> Nasi Tutug </h4>
							@endif
						</h1>
					</div>

					@section('actions')

					@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")
						<nav class="actions">
							@section('back')
								<ul class="flat left">
									<li><a href="{{ f('controller.url') }}" class="disable"><i class="xn xn-left-open"></i>{{ l('Back') }}</a></li>
									<li><a href="{{ f('controller.url', '/null/create') }}"><i class="xn xn-plus"></i>{{ l('New') }}</a></li>
									<li><a href="{{ f('controller.url') }}" class="disable"><i class="xn xn-pencil"></i> {{ l('Edit') }}</a></li>
									<li class="search">
										<nav id="search">
											<div class="search-area">
												<span class="icn xn xn-search"></span>
												<form action="#" class="input-search">
													<input type="text" placeholder="Search Here...">
												</form>
											</div>
										</nav>
									</li>
								</ul>
							@show
							<div class="clear"></div>
						</nav>
					@endif

					@show
					<div class="pull-right">
						@section('usermenu')
							<ul class="topbar">

							@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")
								<li class="sub notification first-child odd" style="padding: 0 3px 0 0;">
									<a href="#" class="">
										<i class="xn xn-bell"></i>
										<?php  $pesan = Norm::factory('Pesan')->find(array('status' => "Baru Pesan")); ?>
										<span class="icn-right badge round solid error">{{ count($pesan) }}</span> </a>
									</a>
									<ul class="context-menu">
										<li class="first-child odd"><a href="#">Inbox</a></li>
										<li class="even"><a href="#">Trash</a></li>
										<li class="last-child odd"><a href="#">Deleted</a></li>
									</ul>
								</li>
								<li class="sub user even" style="padding: 2px 0 0 40px!important;">
									<a href="#" class="">
										<span class=""> <?php echo $_SESSION['user']['nama_depan']; ?>&nbsp;<?php echo $_SESSION['user']['nama_belakang']; ?> </span>
										<i class="xn xn-down-open-mini"></i>
									</a>
									<ul class="context-menu right">
										<li class="first-child odd"><a href="<?php echo URL::site('logout'); ?>"> <i class="xn xn-logout"> </i>Keluar</a></li>
										
									</ul>
								</li>

							@endif
 
 								@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 
									<!-- <li class="sub user">
										<div class="container">
										    <form class="searchbox">
										        <input type="text" placeholder="Pencarian" name="search" class="searchbox-input" onkeyup="buttonUp();" style="border: 0;color: #416B9B; line-height: 130%; box-shadow: none; padding:12px">
										    </form>									    <span class="searchbox-icon"> <i class="xn xn-search" style="margin: 1px 28px; color: #fff; font-size: 20px;"> </i> </span>
										</div>
									</li> -->
	 								<!-- <li class="sub user"> -->
	 								
						                <!-- <div class="search-area dropdown-search">
						                    <span href="#" class="dropdown-button open" style="right: 7px;"><i class="xn xn-search" style="margin: 12px 36px; color: #fff; font-size: 20px;"></i></span>
						                </div>

						                <div class="advanced-area hover">
						                    <form method="get" class="hover">
						                        <div class="select" style="padding: 0px 0px 7px;">
						                        
						                        <form action="#" class="form-calendar">
						                        <input type="text" style="margin:-1px -11px;" placeholder="Search Here..." class="text">
						                    </form>
						                    </form>
						                </div> -->
	 								
						            <!-- </li> -->
						        @endif


								
								@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 
									<li class="sub notification first-child odd" style="padding: 0px 0px 0px 0px;">
										<!-- <a href="#" class="">
											<i class="xn xn-search" style="color: #fff; font-size: 20px; margin: 0px -11px;"></i>
										</a> -->
										 <form action="" class="search-form">
							                <div class="form-group has-feedback" style="margin: 3px -22px;">
							            		<label for="search" class="sr-only">Search</label>
							            		<input type="text" class="form-control" name="search" id="search" placeholder="Pencarian" style="border: 0;outline: 0;">
							              		<span class="xn xn-search form-control-feedback" style="font-size: 20px; color: #fff;"></span>
							            	</div>
							            </form>

									</li>
									<li class="devider"></li>
									<li class="">
										
										@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user")
											<?php  $id_user = $_SESSION['user']['$id']; ?>
											<?php  $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 1)) ?>

											@if (count($keranjang) != 0)
												<a href="<?php echo URL::base('/index.php/menuMakanan/null/keranjangBelanja'); ?>">
											@else 
												<a href="#">
											@endif

										@endif
									
											<i class="xn xn-basket" style="color: #fff; font-size: 20px; margin: 0px -16px;"></i>

												@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user")				
													<?php  $id_user = $_SESSION['user']['$id']; ?>
													<?php  $keranjang = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 1)) ?>
													<?php  $keranjangSelesai = Norm::factory('Keranjang')->find(array('id_user' => $id_user, 'status' => 2)) ?>
													<span class="badge solid round error" style="background:#434D5D; margin-left: -0px;">{{ count($keranjang) }}</span>
												@endif
										</a>
									</li>
								@endif
							</ul>
						@show
					</div>
				</nav>
			@show

			@section('sidebar')

				<link rel="import" href="{{{ Theme::base('vendor/pants-images/pants-images.html') }}}">
				<aside class="sidebar">

				@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user" || empty($_SESSION['user']) ) 	
					
					<style type="text/css">
					.sidebar .nav.with-icon li {
					    padding-left: 40px;
					    padding-top: 9px;
					}
					</style>

					<ul class="nav with-icon background">

					<li class="fontcolor"><a href="<?php echo URL::base('') ?>" style='color:#fff; '><i class="icn-left xn xn-home"></i> Beranda <i class="icn-right xn xn-right-open-mini"></i></a></li> 
					<li class="fontcolor"><a href="<?php echo URL::site('profil/null/tentangKami') ?>" style='color:#fff; '><i class="icn-left xn xn-user"></i> Tentang Kami <i class="icn-right xn xn-right-open-mini"></i></a></li> 
					<li class="fontcolor"><a href="<?php echo URL::site('caraPembelian') ?>" style='color:#fff; '><i class="icn-left xn xn-newspaper"></i> Cara Pembelian <i class="icn-right xn xn-right-open-mini"></i></a></li> 
					<li class="fontcolor"><a href="<?php echo URL::site('menuMakanan') ?>" style='color:#fff; '><i class="icn-left xn xn-menu"></i> Menu Makanan <i class="icn-right xn xn-right-open-mini"></i></a></li> 
					@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user")
						@if (count($keranjang) != 0)
						<li class="fontcolor"><a href="<?php echo URL::site('menuMakanan/null/keranjangBelanja') ?>" style='color:#fff; '><i class="icn-left xn xn-basket"></i> Keranjang Pembelian <span class="icn-right badge round solid error" style="background: #434D5D;">{{ count($keranjang) }}</span></a></li> 
						@endif
					@endif
					<li class="fontcolor"><a href="<?php echo URL::site('hubungi/null/create') ?>" style='color:#fff; '><i class="icn-left xn xn-mobile"></i> Hubungi Kami <i class="icn-right xn xn-right-open-mini"></i></a></li> 
					@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user")
						@if(count($keranjangSelesai) !=0)
							<li class="fontcolor"><a href="<?php echo URL::site('riwayat') ?>" style='color:#fff; '><i class="icn-left xn xn-book-open"></i> Riwayat <i class="icn-right xn xn-right-open-mini"></i></a></li> 
						@endif
					@else
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
					@endif

					@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user")
						<?php $riwayat = Norm::factory('Pesan')->find(array('id_user' => $id_user)); ?>
						
						@if (count($riwayat) == 0) 
							<li class="devider"></li>
							<li class="devider"></li>						
							<li class="devider"></li>						
						@endif	

					@endif				

					@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "user")
						@if (count($keranjang) == 0)
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						@endif
					@endif			

					<li class="devider"></li>
					<li class="devider"></li>
					@if (empty($_SESSION['user'])) 
					<li class="devider"></li>
					<li class="devider"></li>
					<li class="devider"></li>
					<li class="devider"></li>
					<li class="devider"></li>
					<li class="devider"></li>
					@else
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
					@endif

					@if (empty($_SESSION['user'])) 
						<li class="fontcolor"><a href="<?php echo URL::site('user/null/create') ?>" style='color:#fff;'><i class="icn-left xn xn-user-add"></i> Register <i class="icn-right xn xn-right-open-mini"></i></a></li>
						<li class="fontcolor"><a href="<?php echo URL::site('login') ?>" style='color:#fff;'><i class="icn-left xn xn-login"></i> Login <i class="icn-right xn xn-right-open-mini"></i></a></li>
						<li class="devider"></li>
						<li class="devider"></li>
					@else 
						
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="devider"></li>
						<li class="fontcolor"><a href="<?php echo URL::site('logout') ?>" style='color:#fff;'><i class="icn-left xn xn-logout"></i> Logout <i class="icn-right xn xn-right-open-mini"></i></a></li>
						<li class="devider"></li>
						<li class="devider"></li>
					@endif
							
				@endif

				@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")	
					<ul class="nav with-icon">
					<li><a href="<?php echo URL::site('/static') ?>"><i class="icn-left xn xn-home"></i> Dashboard <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li class="devider"></li>

					<a href="#" class="menu expand"><h3 class="group-list">Master Data<i class='xn xn-minus-squared'></i></h3></a>
					<li><a href="<?php echo URL::site('profil') ?>"><i class="icn-left xn xn-home"></i> Profil <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li><a href="<?php echo URL::site('kategori') ?>"><i class="icn-left xn xn-doc-text"></i> Kategori <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li><a href="<?php echo URL::site('ongkos') ?>"><i class="icn-left xn xn-docs"></i> Ongkos Kirim <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li><a href="<?php echo URL::site('makanan') ?>"><i class="icn-left xn xn-menu"></i> Daftar Makanan <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li class="devider"></li>
					
					<a href="#" class="menu expand"><h3 class="group-list"> Inbox <i class='xn xn-minus-squared'></i></h3></a>
					<li><a href="<?php echo URL::site('pesan') ?>"><i class="icn-left xn xn-basket"></i> Pesan 
						<?php  $pesan = Norm::factory('Pesan')->find(array('status' => "Baru Pesan")); ?>
						<span class="icn-right badge round solid error">{{ count($pesan) }}</span> </a>
					</li>
					<li><a href="<?php echo URL::site('hubungi') ?>"><i class="icn-left xn xn-mobile"></i> Hubungi Kami <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li class="devider"></li>

					<a href="#" class="menu expand"><h3 class="group-list">Report<i class='xn xn-minus-squared'></i></h3></a>
					<li><a href="<?php echo URL::site('/pesan/null/transaksi?transaksi-hari-ini='.date('m-d-Y')) ?>"><i class="icn-left xn xn-doc"></i> Transaksi Hari Ini <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li><a href="<?php echo URL::site('pesan/null/laporan') ?>"><i class="icn-left xn xn-pencil"></i> Laporan <i class="icn-right xn xn-right-open-mini"></i></a></li>
					<li class="devider"></li>

					<a href="#" class="menu expand"><h3 class="group-list">System<i class='xn xn-minus-squared'></i></h3></a>			
					<li><a href="<?php echo URL::site('user') ?>"><i class="icn-left xn xn-user"></i> User <i class="icn-right xn xn-right-open-mini"></i></a></li>
				@endif

					</ul>
				</aside>
			@show

			@section('page')
			@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")	
				<main class="content @section('main.classes')
						has-contextual
					@show">
			@endif

					@section('content')
						<div class="wrapper">
							@section('fields')
								&nbsp;
							@show
						</div>
					@show

				@if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin")	
					@section('contextual')
						<nav id="contextual">
							@section('contextual.content')
								&nbsp;
							@show
						</nav>
					@show
				</main>
				@endif

			@show
		@show

		@section('customjs')
			<!-- Custom JS -->
			<script type="text/javascript">
	            tinymce.init({
	                selector: "mytextarea",
	                menu: {},
	                plugins: "table, hr, link, image, textcolor",
	                toolbar: [
                    	"bold italic underline | alignleft aligncenter alignright alignjustify | cut copy paste | bullist numlist outdent indent | undo redo | hr link unlink image table | forecolor formatselect fontselect fontsizeselect"
	                ],
	                convert_urls: false
	             });

				document.querySelector( "#nav-toggle" )
				  .addEventListener( "click", function() {
				    this.classList.toggle( "active" );
				  });
	        </script>

		@show

	</body>
</html>