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

    <form method="post" id="createform" class="read">
        <h4 class="sub-title"> Register Pelanggan </h4>
        <div class="row">
            <div class="span-12">
                <label> Nama Lengkap* </label>
                <input type="text" name="nama">
            </div>
            <div class="span-12">
                <label> Username* </label>
                <input type="text" name="username">
            </div>
            <div class="span-12">
                <label> Password* </label>
                <input type="password" name="subjek">
            </div>
            <div class="span-12">
                <label> No Telepon* </label>
                <input type="text" name="no_telepon">
            </div>
            <div class="span-12">
                <label> Email* </label>
                <input type="text" name="email">
            </div>
            <div class="span-12">
                <label> Alamat* </label>
                <textarea name="alamat" style="border: 0; outline: 0;background: transparent;border-bottom: 1px solid #c6d5e7;"></textarea>
            </div>
            <div class="span-12"> <br />
                <center>
                    <input type="submit" value="Simpan Data Diri" class="button solid" style="width: 280px; height: 36px;" onclick="$('#createform').submit ()" />
                </center>
            </div>
        </div>
        <input type="submit" value="Submit" class="hidden" />
    </form>
@stop

section('contextual.content')
    
@stop