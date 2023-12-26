@extends('layouts.dashboard')

@section('title', 'Edit category')


@section('content')
<div class="container">

<form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @include('dashboard.category._form', [
        'button_label' => 'Update'    
    ])
</form>
</div>
@endsection