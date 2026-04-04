@extends('admin.layout')
@section('title', 'Categories')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 text-sm font-semibold">+ Add Category</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Order</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Color</th>
                <th class="px-4 py-3 text-center">Products</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $cat)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $cat->order }}</td>
                <td class="px-4 py-3 font-semibold">
                    <span class="inline-flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full" style="background: {{ $cat->icon_color }}"></span>
                        {{ $cat->name }}
                    </span>
                </td>
                <td class="px-4 py-3"><span class="w-6 h-6 inline-block rounded" style="background: {{ $cat->bg_color }}"></span></td>
                <td class="px-4 py-3 text-center">{{ $cat->products_count }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-0.5 rounded-full text-xs {{ $cat->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span>
                </td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.categories.edit', $cat) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">No categories yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
