@extends('layouts.turismo')

@section('title', 'Edit Produk | TURISMO')

@section('content')
@include('partials.page-header', ['eyebrow' => 'ADMIN PANEL', 'title' => 'Edit ' . $product->name])

<div class="max-w-3xl mx-auto px-6 py-14">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form')
    </form>
</div>
@endsection
