@extends('admin.layout')
@section('title', 'Edit Product')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Edit Product</h1>
    <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.products._form')
        <div class="mt-6">
            <button type="submit" class="px-6 py-2.5 bg-pink-500 text-white rounded-lg hover:bg-pink-600 font-semibold">Update Product</button>
        </div>
    </form>
</div>
@endsection
