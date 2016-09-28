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
@stop

@section('content')
    
    <form method="get" id="search-form" class="wrapper full">
        <div class="table-container">
            <table class="table nowrap hover">
                <thead>
                    
                    <tr>
                        <th><a href="">Nama Pemesan</a></th>
                        <th><a href="">Waktu Pesan</a></th>
                        <th><a href="">Telepon</a></th>
                        <th><a href="">Keterangan</a></th>
                        <th><a href="">Status</a></th>
                        <th><a href="">Aksi</a></th>
                    </tr>
                    
                </thead>
                <tbody>
                        
                        @foreach ($entries as $value)
                        <tr>
                            <td> {{ $value['nama_pemesan'] }} </td>
                            <td> {{ $value['tgl_pesan'] }} | {{ $value['jam'] }} </td>
                            <td> {{ $value['telepon'] }} </td>
                            <td> {{ $value['keterangan'] }} </td>
                            @if (!empty($value['status'] == 'Baru Pesan'))
                                <td> <button style="background:#ffffff"> <a style="color:#CF4741"> {{ $value['status'] }} </a> </button> </td>
                            @endif
                            @if (!empty($value['status'] == 'Proses Pengiriman'))
                                <td> <button style="background:#ffffff"> <a> {{ $value['status'] }} </a> </button> </td>
                            @endif
                            @if (!empty($value['status'] == 'Terkirim'))
                                <td>  <button style="background:#ffffff"> <a style="color:#a3bf7a"> {{ $value['status'] }} </a> </button> </td>
                            @endif
                            <td><a href="{{ f('controller.url', '/'.$value['$id']) }}"> Detail </a></td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </form>
        
@stop


@section('contextual')

@stop