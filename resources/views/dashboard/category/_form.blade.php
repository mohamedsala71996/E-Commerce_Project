
<div class="form-group">
    <x-forms.label for='name' value='Name' />
    <x-forms.input type='text' name='name' :value="$category->name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required/>
    <x-forms.errorMessage name='name' message='message' />
</div>

<div class="form-group">
    <x-forms.label for='description' value='Description' />
    {{-- <textarea class="form-control" id="description" name="description" rows="3">{{old('description',$category->description)}}</textarea> --}}
    <x-forms.textarea class="form-control" id='description' rows="3" name="description" :value="$category->description" />
</div>
<input type="hidden" name='id' value='{{$category->id}}' >
<div class="form-group">
    <x-forms.label for='parent_id' value='Parent' />
    {{-- <select class="form-control" id="parent" name="parent_id">
        <option value="">Select Parent</option>
        @forelse ($parents as $parent)
            <option @selected($parent->id==old('parent_id',$category->parent_id)) value="{{ $parent->id }}">{{ $parent->name }}</option>
        @empty
            <option value="" disabled>No parents available</option>
        @endforelse
    </select> --}}
    <x-forms.select name='parent_id' label='Select Parent' :options="$parents" :selected="$category->parent_id" />

</div>

<div class="form-group">
    <x-forms.checkRadio label='status' :options="['active'=>'Active','archived'=>'Archived']" name='status' :checked="$category->status" />
</div>

<div class="form-group">
    <x-forms.label for='image' value='Choose an image' />
    <x-forms.input type='file' class="form-control-file" accept="image/*" name="image"/>
    @if ($category->image)
    <img src="{{ asset("storage/$category->image") }}" alt='No photo exists' class="img-thumbnail" height="50" width="50">
    @endif
</div>

<button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
