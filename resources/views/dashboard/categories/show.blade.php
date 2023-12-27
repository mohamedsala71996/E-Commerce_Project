@extends('layouts.dashboard')

@section('styles')
@endsection

@section('title', 'Products')



@section('content')
<div class="container ">


    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Store</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products=$category->products()->with('store')->paginate(10) as $product)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td class="align-middle {{ $product->status === 'active' ? 'text-success' : ($product->status === 'archived' ? 'text-danger' : 'text-warning') }}">
                            {{ $product->status }}
                        </td>                                     
                        <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No products defined.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}

    </div>
</div>

@endsection

@section('scripts')
@endsection
