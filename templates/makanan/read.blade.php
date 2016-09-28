@extends('layout')

<?php use ROH\Util\Inflector; use Norm\Schema\Reference; ?>

@section('pagetitle')
    {{ l('{0}: ', array(Inflector::humanize(f('controller')->getClass()))).$entry->format() }}
@stop

@section('back')
    <ul class="flat left">
        <li><a href="{{ f('controller.url') }}"><i class="xn xn-left-open"></i>{{ l('Back') }}</a></li>
        <li><a href="{{ f('controller.url', '/null/create') }}"><i class="xn xn-plus"></i>{{ l('New') }}</a></li>
        <li><a href="{{ f('controller.url', '/:id/update') }}"><i class="xn xn-pencil"></i> {{ l('Edit') }}</a></li>
    </ul>
@stop

@section('fields')
  <paper-detail>
      <h2 class="subtitle">{{ l('{0}', Inflector::humanize(f('controller')->getClass())) }}</h2>
      <div class="row">
          <div class="span-6">
            <row>
            <label> Nama Makanan </label>
              <info> {{ $entry['nama'] }} </info>
            </row>
          </div>
          <div class="span-6">
            <row>
            <label> Harga </label>
              <info> {{ $entry['harga'] }} </info>
            </row>
          </div>
          <div class="span-6">
            <row>
            <label> Stok </label>
              <info> {{ $entry['stok'] }} </info>
            </row>
          </div>
          <div class="span-6">
            <row>
            <label> Kategori </label>
              <info> {{ Reference::create('id_kategori','kategori')->to('Kategori','nama')->format('plain', $entry['id_kategori']) }} </info>
            </row>
          </div>
          <div class="span-6">
            <row>
            <label> Deskripsi </label>
              <info> {{ $entry['deskripsi'] }} </info>
            </row>
          </div>
          <div class="span-6">
            <row>
            <label> Gambar </label>
              <info> <img style="width: 104px; border-radius: 11px; height: 98px;" width="" src="<?php echo  URL::base('data/makanan/'.$entry['picture']); ?>"> </info>
            </row>
          </div>
      </div>
    </paper-detail>
@stop

@section('contextual.content')
    <nav class="row">
        <div class="pull-left">
          @if(f('auth.allowed', f('controller.uri', '/:id/delete')))
            <a href="{{ f('controller.url', '/:id/delete') }}" class="button error popup noclose modal"><i class="xn xn-trash"></i>{{{ l('Delete') }}}</a>
          @endif
        </div>
        <div class="pull-right">&nbsp;</div>
    </nav>
@stop