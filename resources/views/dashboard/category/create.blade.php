@extends('layouts.dashboard')

@section('title', 'Create category')


@section('content')
<div class="container">

<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    @include('dashboard.category._form')
</form>
</div>
@endsection