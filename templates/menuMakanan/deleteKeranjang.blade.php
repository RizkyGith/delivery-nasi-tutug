<form method="post" action="{{ f('controller.url', '/'.$id.'/deleteKeranjang') }}" id="deleteRecord" class="read">
	<p class="banner"><i class="xn xn-newspaper xn-3x"></i><i class="xn xn-right-bold xn-3x"></i><i class="xn xn-trash xn-3x"></i></p>
    <!-- <p>Are you sure want to delete this record?</p> -->
<ul class="actions">
    <li><a href="#" onclick="$('#deleteRecord').submit (); return false;" class="error">Yes</a></li>
    <li class="primary"><a href="#" onclick="$.fn.popup().close(); return false;">No</a></li>
</ul>
</form>
