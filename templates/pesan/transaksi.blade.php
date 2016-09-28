@extends('layout')

<?php use ROH\Util\Inflector; 
      use App\Library\Pagination; ?>

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

@section('main.classes')
    @if(!$entries->count(true))
        has-actions
    @else
        has-actions has-table
    @endif
@stop

@section('tabssearch')
@stop

@section('menu')
    
    <!-- //* kondisi level -->
    @section('back')
        <ul class="flat left">
            <li class="sub">
                <a class="dropdown" href="#">Cetak<i class="xn xn-down-open-mini"></i></a>
                @section('more')
                    <ul class="context-menu" style="top: 45px;">
                        <li>
                             <?php $url = URL::current().'?'.$_SERVER['QUERY_STRING']; ?>
                             <a href="<?php echo $url.'&!export=1&date='.date('m-d-Y') ?>"> {{ l('Export') }} </a> 
                        </li>
                    </ul> 
                @show
            </li>
            <li>
                
                <nav id="contextual-search">

                    <nav class="dropdown-menu">
                        <div class="search-area">
                            <form method="GET">
                                <input type="text" name="name" placeholder="Pencarian Nama...">
                                <span class="icon xn xn-search"></span>
                            </form>
                        </div>
                        <div class="advance-area">
                            <div class="advance-search">
                                <h6 class="dropdown">
                                    Advance Search
                                    <span class="arrow xn-down-open-mini"></span>
                                </h6>
                            </div>
                        </div>
                        <div class="form-menu">
                            <form method="GET">
                                <div class="input-area">
                                    <div class="row">
                                        <div class="span-6">
                                            <div class="wrapper">
                                                <label class="">Bulan</label>
                                                <select name="month">
                                                    <option value="">---</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span-6">
                                            <div class="wrapper">
                                                <label class="">Tahun</label>
                                                <select name="year">
                                                    <option value="">---</option>
                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="span-6" style="padding-top: 9px;">
                                            <label>Keterangan</label>   
                                            <select name="status" style="width: 497px;">
                                                <option>---</option>
                                                <option value="1">Belum Proses</option>
                                                <option value="2">Sudah Diproses</option>
                                                <option value="3">Sudah Diterima</option>
                                                <option value="4">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="button-area row">
                                    <ul class="flat">
                                        <li>
                                            <input type="submit" class="button solid" />
                                        </li>
                                        <li>
                                            <input type="reset" value="Reset" class="button reset solid error" />
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </nav>
                </nav>
            </li>
            <li>
                <div class="search-area dropdown-search">
                    <span class="icn xn xn-search" style="margin: 1px -11px;"></span>
                    <form action="#" class="form-calendar">
                        <input type="text" style="margin:-1px -11px;" placeholder="Search Here...">
                    </form>
                    <!-- <span href="#" class="dropdown-button" style="right: 7px;"><i class="xn xn-down-open-mini"></i></span> -->
                    <!-- <button style="right: 7px;"> Klik </button> -->
                </div>
            </li>
        </ul>
    @stop

@stop

@section('content')
    
    <form method="get" id="search-form" class="wrapper full">
        <div class="table-container">
            <table class="table nowrap hover">
                <thead>

                    <tr>
                        <th><a href="">Nama</a></th>
                        <th><a href="">Tanggal Order</a></th>
                        <th><a href="">Telepon</a></th>
                        <th><a href="">Jam</a></th>
                        <th><a href="">Status</a></th>
                    </tr>
                    
                </thead>
                <tbody>
                        @foreach ($entries as $value)
                            <tr>
                                <td> <a href=""> {{ $value['nama_pemesan'] }} </a> </td>
                                <td> {{ $value['tgl_pesan'] }} | {{ $value['jam'] }} </td>
                                <td> {{ $value['telepon'] }} </td>
                                <td> {{ $value['jam'] }} </td>
                                <td> <button>{{ $value['status'] }}</button> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
        
@stop


@section('contextual')

@stop