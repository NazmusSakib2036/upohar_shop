@extends('admin.layout')

@section('title', 'স্লাইডার এডিট')
@section('page-title', 'স্লাইডার এডিট')

@section('content')
    <div class="max-w-3xl">
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.sliders._form', ['slider' => $slider])
        </form>
    </div>
@endsection
