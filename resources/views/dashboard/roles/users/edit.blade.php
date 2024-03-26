@extends('layouts.dashboard')

@section('title', 'Edit user role')

@section('content')
<div class="container">

    <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group">
            <x-forms.label for='name' value='Name' />
            <x-forms.input type='text' name='name' :value="$user->name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" disabled required/>
            <x-forms.errorMessage name='name' message='message' />
        </div>
        <div class="form-group">
            <x-forms.label for='email' value='Email' />
            <x-forms.input type='text' name='email' :value="$user->email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" disabled required/>
            <x-forms.errorMessage name='email' message='message' />
        </div>

        <legend>{{ __('Roles') }}</legend>
        <div class="container">
            @foreach ($roles as $role)
            <div class="row mb-1">
                <div class="col-md-8">
                    {{ $role->name }}
                </div>

                <div class="col-md-4">
                    {{-- <input type="checkbox" name="roles[{{ $role->name }}]" value="{{ $role->id }}" @checked($role->name==($userRoles[$role->name] ?? '')) class="form-check-input"> --}}
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" @checked(in_array($role->id , $userRolesIds) ) class="form-check-input">
                </div>
            </div>
            <hr>
            @endforeach

            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
