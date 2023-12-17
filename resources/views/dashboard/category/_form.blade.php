
<div class="form-group">
    <label for="name">Name:</label>
    {{-- <input type="text" class="form-control" id="name" name="name" value="{{old('name',$category->name )}}" required> --}}
    <x-forms.input type='text' name='name' :value="$category->name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required/>
    {{-- @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror --}}
    <x-forms.errorMessage name='name' message='message' />
</div>

<div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{old('description',$category->description)}}</textarea>
</div>
<input type="hidden" name='id' value='{{$category->id}}' >
<div class="form-group">
    <label for="parent">Parent:</label>
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
    <label>Status:</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="active" value="active" @checked('active'==old('status',$category->status))>
        <label class="form-check-label" for="active">Active</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="archived" value="archived" @checked('archived'==old('status',$category->status))>
        <label class="form-check-label" for="archived">Archived</label>
    </div>
</div>

<div class="form-group">
    <label for="image">Choose an image:</label>
    <input type="file" class="form-control-file" accept="image/*" id="fileInput" name="image">
    @if ($category->image)
    <img src="{{ asset("storage/$category->image") }}" alt='No photo exists' class="img-thumbnail" height="50" width="50">
    @endif
</div>

<button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
