@props(['type','name','value'])

<input type="{{$type}}" id="{{$name}}" name="{{$name}}" value="{{old($name,$value )}}" {{$attributes}}>
