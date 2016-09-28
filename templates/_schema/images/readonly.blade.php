@if($entry[$self['name']])
    @foreach($entry[$self['name']] as $val)
        <span class="field">
            <img width="200" src="{{ dirname(URL::base()) . '/data/asset/images/' . $val }}" alt="">
        </span>
    @endforeach
@endif