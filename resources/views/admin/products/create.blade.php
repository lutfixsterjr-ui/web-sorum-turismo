@extends('layouts.turismo')

@section('title', 'Tambah Produk | TURISMO')

@section('content')
@include('partials.page-header', ['eyebrow' => 'ADMIN PANEL', 'title' => 'Tambah Produk'])

<div class="max-w-3xl mx-auto px-6 py-14">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.products._form')
    </form>
</div>
@endsection
