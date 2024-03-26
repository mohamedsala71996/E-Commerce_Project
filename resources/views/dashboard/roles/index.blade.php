@extends('layouts.dashboard')

@push('styles')
@endpush

@section('title', 'Roles')



@section('content')

    <div class="mb-3">
        <a href="{{ route('roles.create') }}" class="btn btn-success">Create</a>
        <a href="{{ route('admins.index') }}" class="btn btn-info">Admins</a>
        <a href="{{ route('users.index') }}" class="btn btn-info">Users</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Proccesses</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $role->id }}">
                                Delete
                            </button>
                            @include('dashboard.roles.delete')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No roles defined.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <div class="d-flex justify-content-center">
        {{ $roles->withQueryString()->links() }}

    </div>
</div>

@endsection

@push('scripts')
@endpush
