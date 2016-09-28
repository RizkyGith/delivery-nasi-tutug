@extends('layout')

<?php use ROH\Util\Inflector; ?>

@section('pagetitle')
    {{ l('Create New {0}', Inflector::humanize(f('controller')->getClass())) }}
@stop

@section('main.classes')
    has-actions
@stop

@section('tabssearch')
@stop

@section('menu')
@stop

@section('fields')
    
    <style type="text/css">

        input[type=text] {
            border: 0;
            outline: 0;
            background: transparent;
            border-bottom: 1px solid #c6d5e7;
        }

    </style>

    <?php 
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        $hari = $array_hari[date('N')];
     ?>

    <form method="post" id="createform" class="read">
        <h4 class="sub-title"> Hubungi Kami </h4>
        <div class="row">
            <div class="span-12">
                <label> Tanggal* </label>
                <input type="text" name="tanggal" value="<?php echo $hari; ?>, <?php echo date('m-d-Y'); ?>" disabled>
            </div>
            <div class="span-12">
                <label> Nama* </label>
                <input type="text" name="nama">
            </div>
            <div class="span-12">
                <label> Email* </label>
                <input type="text" name="email">
            </div>
            <div class="span-12">
                <label> Subjek* </label>
                <input type="text" name="subjek">
            </div>
            <div class="span-12">
                <label> Isi Pesan* </label>
                <textarea name="deskripsi" style="border: 0; outline: 0;background: transparent;border-bottom: 1px solid #c6d5e7;"></textarea>
            </div>
            <div class="span-12"> <br />
                <center>
                    <input type="submit" value="Kirim Pesan" class="button solid" style="width: 280px; height: 36px;" onclick="$('#createform').submit ()" />
                </center>
            </div>
        </div>
        <input type="submit" value="Submit" class="hidden" />
    </form>
@stop

section('contextual.content')
    
@stop