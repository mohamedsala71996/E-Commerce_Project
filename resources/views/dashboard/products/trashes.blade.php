@extends('layouts.dashboard')

@section('styles')
@endsection

@section('title', 'Trashed categories')



@section('content')
<div class="container ">
    <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-success">Back</a>
    </div>
    <form action="{{ url()->current() }}" method="GET" class="mb-3">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-2">
                <x-forms.input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}" />
            </div>
            <div class="col-md-4 mb-2">
                <select name="status" class="form-control">
                    <option value="" @selected(request('status') === '') >All</option>
                    <option value="active" @selected(request('status') === 'active')  >Active</option>
                    <option value="archived" @selected(request('status') === 'archived') >Archived</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                        <td class="align-middle {{ $category->status === 'active' ? 'text-success' : 'text-danger' }}">
                            {{ $category->status }}
                        </td>                        <td class="align-middle">
                            <img src="{{ asset("storage/$category->image") }}"
                                alt="{{ $category->name . ' photo not exist' }}"  height="50"
                                width="50">
                        </td>
                        <td>{{ $category->deleted_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('categories.restoreTrashes', $category->id) }}" class="btn btn-sm btn-success">restore</a>
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

    <div class="d-flex justify-content-center">
        {{ $categories->withQueryString()->links() }}

    </div>
</div>

@endsection

@section('scripts')
@endsection
