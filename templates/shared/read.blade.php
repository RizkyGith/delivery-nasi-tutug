@extends('layout')

<?php use ROH\Util\Inflector; ?>

@section('pagetitle')
    {{ l('{0}: ', array(Inflector::humanize(f('controller')->getClass()))).$entry->format() }}
@stop

@section('back')
    <ul class="flat left">
          <li><a href="{{ f('controller.url') }}"><i class="xn xn-left-open"></i>{{ l('Back') }}</a></li>
        @if(f('auth.allowed', f('controller.uri', '/null/create')))
          <li><a href="{{ f('controller.url', '/null/create') }}"><i class="xn xn-plus"></i>{{ l('New') }}</a></li>
        @endif
        @if(f('auth.allowed', f('controller.uri', '/:id/update')))
          <li><a href="{{ f('controller.url', '/:id/update') }}"><i class="xn xn-pencil"></i> {{ l('Edit') }}</a></li>
        @endif
    </ul>
@stop

@section('fields')
  <paper-detail>
      <h2 class="subtitle">{{ l('{0}', Inflector::humanize(f('controller')->getClass())) }}</h2>
      <div class="row">
        <?php $i = 0; ?>
            @foreach (f('controller')->schema() as $name => $field)
                @if (!$field['hidden'])
                  <div class="span-6">
                    <row>
                      {{ $field->label() }}
                      <info>{{ $entry->format($name, 'plain') }}</info>
                    </row>
                  </div>
                 <?php if (++$i % 2 == 0) echo "</div><div class='row'>"; ?>
              @endif
          @endforeach
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