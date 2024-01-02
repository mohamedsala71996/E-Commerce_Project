@extends('layouts.dashboard')

@section('title', 'Edit category')


@section('content')
<div class="container">

<form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @include('dashboard.products._form', [
        'button_label' => 'Update'    
    ])
</form>
</div>
@endsection