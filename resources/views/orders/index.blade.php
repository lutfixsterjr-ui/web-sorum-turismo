@extends('layouts.turismo')

@section('title', 'Pesanan Saya | TURISMO')

@section('content')
@include('partials.page-header', ['eyebrow' => 'AKUN', 'title' => 'Pesanan Saya', 'sub' => 'Riwayat pembelian beserta struk yang bisa dicetak.'])

@php
    $badge = [
        'pending'   => 'bg-amber-100 text-amber-800',
        'paid'      => 'bg-green-100 text-green-800',
        'completed' => 'bg-green-100 text-green-800',
        'cancelled' => 'bg-red-100 text-red-800',
    ];
@endphp

<div class="max-w-7xl mx-auto px-6 py-14">
    @if($orders->isEmpty())
        <div class="border border-dashed border-neutral-300 py-24 text-center">
            <p class="text-2xl font-black">BELUM ADA PESANAN</p>
            <p class="text-neutral-500 mt-2">Pesanan yang kamu buat akan muncul di sini.</p>
            <a href="{{ route('home') }}#inventory" class="btn btn-dark mt-8">LIHAT KOLEKSI</a>
        </div>
    @else
        <div class="overflow-x-auto bg-white border border-neutral-200">
            <table class="w-full text-left">
                <thead class="bg-neutral-950 text-white text-[11px] tracking-widest">
                    <tr>
                        <th class="p-5">KODE</th>
                        <th class="p-5">TANGGAL</th>
                        <th class="p-5 text-center">ITEM</th>
                        <th class="p-5">TOTAL</th>
                        <th class="p-5">STATUS</th>
                        <th class="p-5 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $o)
                        <tr class="border-t hover:bg-neutral-50 transition">
                            <td class="p-5 font-black">{{ $o->code }}</td>
                            <td class="p-5 text-sm text-neutral-600">{{ $o->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-5 text-sm text-center">{{ $o->items_count }}</td>
                            <td class="p-5 font-bold">{{ \App\Models\Product::rupiah($o->total) }}</td>
                            <td class="p-5">
                                <span class="inline-block text-[10px] font-bold tracking-widest uppercase px-3 py-1 {{ $badge[$o->status] ?? 'bg-neutral-100 text-neutral-700' }}">
                                    {{ $o->status }}
                                </span>
                            </td>
                            <td class="p-5">
                                <div class="flex justify-end gap-5 text-xs font-bold tracking-widest">
                                    <a href="{{ route('orders.show', $o) }}" class="hover:text-red-600">DETAIL</a>
                                    <a href="{{ route('orders.print', $o) }}" target="_blank" class="text-red-600 hover:underline">CETAK</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
