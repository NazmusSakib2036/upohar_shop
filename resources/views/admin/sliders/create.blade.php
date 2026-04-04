@extends('admin.layout')

@section('title', 'নতুন স্লাইডার তৈরি')
@section('page-title', 'নতুন স্লাইডার তৈরি')

@section('content')
    <div class="max-w-3xl">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.sliders._form', ['slider' => new \App\Models\Slider()])
        </form>
    </div>
@endsection
