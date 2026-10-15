@extends('layouts.turismo')

@section('title', 'Kelola Produk | TURISMO')

@section('content')
@include('partials.page-header', ['eyebrow' => 'ADMIN PANEL', 'title' => 'Kelola Produk', 'sub' => 'Tambah, ubah, atau hapus model yang tampil di showroom.'])

<div class="max-w-7xl mx-auto px-6 py-14">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <p class="text-sm text-neutral-500">{{ $products->total() }} produk terdaftar</p>
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark">+ TAMBAH PRODUK</a>
    </div>

    <div class="overflow-x-auto bg-white border border-neutral-200">
        <table class="w-full text-left">
            <thead class="bg-neutral-950 text-white text-[11px] tracking-widest">
                <tr>
                    <th class="p-5">GAMBAR</th>
                    <th class="p-5">NAMA</th>
                    <th class="p-5">SEGMEN</th>
                    <th class="p-5">HARGA</th>
                    <th class="p-5 text-right">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr class="border-t hover:bg-neutral-50 transition">
                        <td class="p-4">
                            <div class="car-stage w-32 h-20 flex items-center justify-center p-2">
                                @if($p->image_url)
                                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="max-h-full object-contain">
                                @else
                                    <span class="text-[10px] text-neutral-400">NO IMAGE</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 font-black uppercase">{{ $p->name }}</td>
                        <td class="p-4"><span class="chip">{{ $p->segment_label }}</span></td>
                        <td class="p-4 font-bold">{{ $p->price_formatted }}</td>
                        <td class="p-4">
                            <div class="flex items-center justify-end gap-5 text-xs font-bold tracking-widest">
                                <a href="{{ route('admin.products.edit', $p) }}" class="hover:text-red-600">EDIT</a>

                                <form action="{{ route('admin.products.destroy', $p) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-14 text-center text-neutral-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">{{ $products->links() }}</div>
</div>
@endsection
