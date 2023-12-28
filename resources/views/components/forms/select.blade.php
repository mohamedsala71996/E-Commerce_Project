@props(['name','label'=>'','options','selected'=>''])

<select class="form-control"  name="{{$name}}">
    <option value="" disabled selected>{{$label}}</option>
    @forelse ($options as $value)
        <option @selected($value->id==old($name,$selected)) value="{{ $value->id }}">{{ $value->name }}</option>
    @empty
        <option value="" disabled>No data available</option>
    @endforelse
</select>