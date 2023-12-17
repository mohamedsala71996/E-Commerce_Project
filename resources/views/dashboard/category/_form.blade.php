
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
    <x-forms.label for='parent' value='Parent' />
    <select class="form-control" id="parent" name="parent_id">
        <option value="">Select Parent</option>
        @forelse ($parents as $parent)
            <option @selected($parent->id==old('parent_id',$category->parent_id)) value="{{ $parent->id }}">{{ $parent->name }}</option>
        @empty
            <option value="" disabled>No parents available</option>
        @endforelse
    </select>
</div>

<div class="form-group">
    {{-- <label>Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="active" value="active" @checked('active'==old('status',$category->status))>
        <label class="form-check-label" for="active">Active</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="archived" value="archived" @checked('archived'==old('status',$category->status))>
        <label class="form-check-label" for="archived">Archived</label>

    </div> --}}
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
