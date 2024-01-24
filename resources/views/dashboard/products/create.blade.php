@extends('layouts.dashboard')

@section('title', 'Create product')


@section('content')
<div class="container">

<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    @include('dashboard.products._form')
</form>
</div>
@endsection