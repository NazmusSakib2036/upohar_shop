@extends('admin.layout')
@section('title', 'Products')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 text-sm font-semibold">+ Add Product</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Image</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Category</th>
                <th class="px-4 py-3 text-right">Price</th>
                <th class="px-4 py-3 text-center">Stock</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 rounded-lg object-cover">
                    @else
                        <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center text-xl">🎁</div>
                    @endif
                </td>
                <td class="px-4 py-3 font-semibold max-w-[200px] truncate">
                    {{ $product->name }}
                    @if($product->is_combo) <span class="text-xs text-pink-500">[COMBO]</span> @endif
                    @if($product->is_featured) <span class="text-xs text-yellow-500">★</span> @endif
                </td>
                <td class="px-4 py-3 text-gray-500">{{ $product->category->name ?? '-' }}</td>
                <td class="px-4 py-3 text-right font-semibold">৳{{ number_format($product->price, 0) }}</td>
                <td class="px-4 py-3 text-center">{{ $product->stock }}</td>
                <td class="px-4 py-3 text-center">
                    <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="inline">
                        @csrf
                        <button class="px-2 py-0.5 rounded-full text-xs {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">No products yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
