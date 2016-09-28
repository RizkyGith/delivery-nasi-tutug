<div class="content">

	<div style="margin-top: -13px;">
		<p class="contentPopup"> Total Belanja : Rp. {{ $totalkeranjang }}</p> 
		<p class="contentPopup"> Ongkos Kirim : Rp. {{ $ongkos }} </p> <hr />
	</div>
	<div class="pull-right">
		<a class="subtotalPopup"> SubTotal : Rp. {{ $jumlah }} <br /></a><br /> 
	</div>

	<a href="#" class="close" onclick="$.fn.popup().close();"><i class="xn xn-close"></i></a> <br />

	<div class="pull-right">
		<a href="{{ f('controller.url', '/' .$totalKeselurahanUser. '/selesaiBelanja') }}" class="badge"> Apakah Anda Setuju </a>
	</div>

</div>