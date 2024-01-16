@push('styles')
    <!-- tags style -->
    <link rel="stylesheet" href="{{ asset('/css/amsify.suggestags.css') }}">
@endpush



<div class="form-group">
    <x-forms.label for='name' value='Name' />
    <x-forms.input type='text' name='name' :value="$product->name"
        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required />
    <x-forms.errorMessage name='name' message='message' />
</div>
<div class="form-group">
    <x-forms.label for='price' value='Price' />
    <x-forms.input type='number' name='price' :value="$product->price"
        class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" required />
    <x-forms.errorMessage name='price' message='message' />
</div>
<div class="form-group">
    <x-forms.label for='compare_price' value='Compare price' />
    <x-forms.input type='number' name='compare_price' :value="$product->compare_price"
        class="form-control {{ $errors->has('compare_price') ? 'is-invalid' : '' }}" required />
    <x-forms.errorMessage name='compare_price' message='message' />
</div>

<div class="form-group">
    <x-forms.label for='Quantity' value='quantity' />
    <x-forms.input type='number' name='quantity' :value="$product->quantity"
        class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" required />
    <x-forms.errorMessage name='quantity' message='message' />
</div>

<div class="form-group">
    <x-forms.label for='description' value='Description' />
    <x-forms.textarea class="form-control" id='description' rows="3" name="description" :value="$product->description" />
</div>
<input type="hidden" name='id' value='{{ $product->id }}'>
<div class="form-group">
    <x-forms.label for='category_id' value='Category' />
    <x-forms.select name='category_id' label='Select Category' :options="$categories" :selected="$product->category_id" />
    <x-forms.errorMessage name='category_id' message='message' />
</div>
<input type="hidden" name="store_id" value="{{ auth()->user()->store_id }}">
<div class="form-group">
    <x-forms.checkRadio label='status' :options="['active' => 'Active', 'archived' => 'Archived', 'draft' => 'draft']" name='status' :checked="$product->status" />
    <x-forms.errorMessage name='status' message='message' />
</div>

<div class="form-group">
    <x-forms.label for='tags' value='Tags' />
    <x-forms.input type='text' name='tags' :value="$tags ?? ''"
        {{-- class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" --}}
     />
    <x-forms.errorMessage name='tags' message='message' />
</div>

<div class="form-group">
    <x-forms.label for='image' value='Choose an image' />
    <x-forms.input type='file' class="form-control-file" accept="image/*" name="image" />
    <x-forms.errorMessage name='image' message='message' />
    @if ($product->image)
        <img src="{{ asset("storage/$product->image") }}" alt='No photo exists' class="img-thumbnail" height="50"
            width="50">
    @endif
</div>

<button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>



@push('scripts')
    <!-- tags js -->
    <script src="{{ asset('/js/jquery.amsify.suggestags.js') }}"></script>
    <script>
        $('input[name="tags"]').amsifySuggestags();
    </script>
@endpush
