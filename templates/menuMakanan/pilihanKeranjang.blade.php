
<div class="content">
	<form action="{{ f('controller.url', '/:id/keranjang') }}" method="get">
		<input type="number" name="qty" placeholder="Berapa Banyak">
		<a href="#" class="close" onclick="$.fn.popup().close();"><i class="xn xn-close"></i></a> <br />

		<div class="pull-right">
			<button class="badge"> Beli </button>
		</div>
	</form>
</div>