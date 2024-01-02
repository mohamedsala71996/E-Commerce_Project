@extends('layouts.dashboard')

@push('styles')
@endpush

@section('title', 'Products')



@section('content')
<div class="container ">

    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Create</a>
        {{-- <a href="{{ route('products.trashes') }}" class="btn btn-danger">view trashes</a> --}}
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
</div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Store</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->store->name ?? '-'}}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td class="align-middle {{ $product->status === 'active' ? 'text-success' : ($product->status === 'archived' ? 'text-danger' : 'text-warning') }}">
                            {{ $product->status }}
                        </td>                                     
                        <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $product->id }}">
                                Delete
                            </button>
                            @include('dashboard.products.delete')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No products defined.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}

    </div>
</div>

@endsection

@push('scripts')
@endpush
