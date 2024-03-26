@extends('layouts.dashboard')

@push('styles')
@endpush

@section('title', 'Roles')



@section('content')



    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admins.edit', $admin->id) }}" title="Edit roles"  >{{ $admin->name }}</a></td>
                        <td>{{ $admin->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No data defined.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <div class="d-flex justify-content-center">
        {{ $admins->withQueryString()->links() }}

    </div>
</div>

@endsection

@push('scripts')
@endpush
