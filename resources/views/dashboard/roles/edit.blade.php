@extends('layouts.dashboard')

@section('title', 'Edit role')


@section('content')
<div class="container">

<form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @include('dashboard.roles._form', [
        'button_label' => 'Update'    
    ])
</form>
</div>
@endsection