@extends('layouts.dashboard')

@section('title', 'Create role')


@section('content')
<div class="container">

<form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    @include('dashboard.roles._form')
</form>
</div>
@endsection