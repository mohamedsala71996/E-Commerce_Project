@props(['name','id','value','data','label'])

<input class="form-check-input" type="radio" name="{{$name}}" id="{{$id}}" value="{{$value}}" @checked($value==old($name,$data))>
<label class="form-check-label" for="{{$id}}">{{$label}}</label>