@extends('skeleton')

<?php 
    use ROH\Util\Inflector;
    use App\Library\Pagination;
 ?>

<?php
$schema = array();
foreach (f('controller')->schema() as $key => $field) {
    if ($field['list-column']) {
        $schema[$key] = $field;
    }
}
?>

@section('pagetitle')
   {{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}
@stop


@section('tabssearch')
@stop

@section('menu')
@stop

@section('content')
    <div class="wrapper">
        <h4 class="sub-title" style=" padding-bottom: 12px; color: #F95C5C; font-weight: 500; line-height: 126%; border-bottom: 1px solid #c6d5e7; font-size: 14px;"> <i class="xn xn-doc-text"></i> Menu Makanan Tersedia</h4>
        <div class="container">
            @foreach ($entries as $key => $value) 
                <div class="row">
                    <div class="span-7">
                        <img style="width:110px; border-radius:48%;" src="<?php echo Theme::base('data/makanan/'. $value['picture'] ) ?>" alt="Bono" / > <br />
                    </div>
                    <div class="span-5">
                    <form>
                        <h4 style="font-size: 14px; color:#F95C5C;"> <strong>{{ $value['nama'] }}</strong> </h4>
                        <h4 style="font-size: 15px;"> <a> Rp. {{ number_format ($value['harga']) }} </a> </h4> 
                        <h4 style="font-size: 14px; color:#F95C5C;"> <strong>Stok : {{ $value['stok'] }} </strong> </h4>

                        <!-- //* nanti pakai id session aktif user , ganti null -->

                        @if (empty($_SESSION['user'])) 
                            <a href="<?php echo URL::site('/login'); ?>" class="badge"> <i class="xn xn-basket"></i> Beli</a>
                        @else 
                            <a href="{{ f('controller.url', '/'.$value['$id'].'/pilihanKeranjang') }}" class="popup badge"> <i class="xn xn-basket"></i> Beli</a>
                        @endif

                    </form>
                    </div>
                </div> <hr />
            @endforeach
        </div>
    </div>    
@stop

