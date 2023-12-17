@props(['label'=>'','name','options','checked'=>''])

@if ($label!='')
<label>{{$label}}</label>
@endif

@foreach ($options as $value => $text)

<div class="form-check">
    <input class="form-check-input" type="radio" name="{{$name}}" id="{{$value}}" value="{{$value}}" @checked($value==old($name,$checked)) {{$attributes}}>
    <label class="form-check-label" for="{{$value}}">{{$text}}</label>
</div>

@endforeach

