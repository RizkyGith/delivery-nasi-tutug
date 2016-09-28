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
        <div class="span-12" style="padding-top: 7px;">

            <p style="font-weight: bold; text-transform: uppercase; font-size: 18px;">Terima Kasih</p>
            <p>
                Untuk Belanja Di Nasi Tutug Oncom, 
                Semoga Anda Puas Kami Senang 
            </p>

            <p>
                Jika mendapatkan informasi lebih lanjut harap hubungi kami 
                ke No <a href=""> 021 - 321 - 000 </a>
            </p>

            <div class="pull-right" style="padding-top: 14px;">
                <a class="badge" href="<?php echo URL::base(); ?>"> <i class="xn xn-home"></i> Kembali ke home </a>
            </div>

        </div>
    </div>


    
@stop


