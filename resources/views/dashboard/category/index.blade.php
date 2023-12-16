@extends('layouts.dashboard')

@section('styles')
@endsection

@section('title', 'Categories')



@section('content')

    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Create</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                        <td>{{ $category->status }}</td>
                        <td class="align-middle">
                            <img src="{{ asset("storage/$category->image") }}"
                                alt="{{ $category->name . ' photo not exist' }}"  height="50"
                                width="50">
                        </td>
                        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $category->id }}">
                                Delete
                            </button>
                            @include('dashboard.category.delete')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No categories defined.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
