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
        <h4 class="sub-title" style=" padding-bottom: 12px; color: #F95C5C; font-weight: 500; line-height: 126%; border-bottom: 1px solid #c6d5e7; font-size: 14px;"> <i class="xn xn-vcard"></i> Total Biaya & Kumpulan Barang</h4>
    </div>

    <center>
        
        <a href="<?php echo URL::site('') ?>" class="badge">Selesai Belanja</a>
    </center>
    
@stop


