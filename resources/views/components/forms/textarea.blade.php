@props(['id'=>'','name','value'])

<textarea {{$attributes}} id="{{$id}}" name="{{$name}}">{{old($name,$value)}}</textarea>
